<?php

use App\Core\Controller;
use App\Model\Midtran;

class webhook extends Controller
{
    public function handleWebhook($request)
    {
        // Ambil payload dari Midtrans
        $payload = $request->all();

        // Validasi signature key (opsional)
        $signatureKey = $request->header('X-Callback-Signature-Key');
        if (!$this->isValidSignature($signatureKey, $payload)) {
            return res(400, ['message' => 'Invalid signature']);
        }

        // Proses payload sesuai dengan status transaksi
        $transactionStatus = $payload['transaction_status'];
        $orderId = $payload['order_id'];

        $transaction = Midtran::where('id', $orderId)->first();

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
                    return res(400, ['message' => 'Unhandled transaction status']);
            }



            return res(200, ['message' => 'Transaction updated successfully']);
        }

        return res(404, ['message' => 'Transaction not found']);
    }

    private function isValidSignature($signatureKey, $payload)
    {
        // Implementasikan validasi signature key sesuai dengan dokumentasi Midtrans
        return true;
    }
}
