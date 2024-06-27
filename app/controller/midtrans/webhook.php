<?php

use App\Core\Controller;
use App\Model\Midtran;

class Webhook extends Controller
{
    public function index()
    {
        // Ambil payload dari Midtrans
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!is_null($payload)) {
            $filename = 'midtrans_payload_' . date('Y-m-d_H-i-s') . '.txt';
            $file_path = __DIR__ . '/../../../datasem/' . $filename; // Ganti dengan path direktori yang sesuai
            file_put_contents($file_path, json_encode($payload, JSON_PRETTY_PRINT));
        }

        // Validasi signature key (opsional)


        // Proses payload sesuai dengan status transaksi
        $transactionStatus = $payload['transaction_status'];
        $orderId = $payload['order_id'];

        $transaction = Midtran::where('order_id', $orderId)->first();

        if ($transaction) {
            switch ($transactionStatus) {
                case 'capture':
                case 'settlement':
                    $transaction->status = 1; // Sukses
                    $transaction->save();
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $transaction->status = 0; // Gagal
                    $transaction->save();
                    break;
                default:
                    return $this->res(400, ['message' => 'Unhandled transaction status']);
            }

            return $this->res(200, ['message' => 'Transaction updated successfully']);
        }

        return $this->res(404, ['message' => 'Transaction not found']);
    }

    private function isValidSignature($signatureKey, $payload)
    {
        // Implementasikan validasi signature key sesuai dengan dokumentasi Midtrans
        $serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $inputSignature = $payload['signature_key'];

        $mySignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $inputSignature === $mySignature;
    }

    private function res($status, $data)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
