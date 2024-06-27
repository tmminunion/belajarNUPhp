<?php

use Midtrans\Snap;
use Midtrans\Config;
use App\Model\member;

use Midtrans\CoreApi;
use App\Model\Midtran as Datmid;
use App\Core\Controller;
use App\Model\PaymentType;

class pembayaran extends Controller
{
    public $auth = true;

    public function __construct()
    {
        parent::__construct();
        Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;
    }

    public function index($d = 'kas', $donid = null)
    {
        last_form();
        $data["clientKey"] = $_ENV['MIDTRANS_CLIENT_KEY'];
        $data["title"] = tanggal_sekarang();
        $data["paymentType"] = PaymentType::all();
        $data["jenis"] = $d;
        $data["type"] = 'kredit';
        $data["judultype"] = 'Pembayaran';
        $data["donid"] = $donid;
        View("pembayaran/midtrans", $data);
    }
    public function post_kas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['Nama'];
            $noreg = $_POST['Noreg'];
            $jumlah = str_replace('Rp. ', '', $_POST['jumlah']);
            $jumlah = str_replace('.', '', $jumlah);
            $keterangan = $_POST['keterangan'];
            $payment_method = $_POST['payment_method'];
            $jenis = $_POST['jenis'];
            $judul = midNumber('KAS');

            $transaction_details = array(
                'order_id' => $judul,
                'gross_amount' => (int) $jumlah,
            );

            $item_details = array(
                array(
                    'id' => 'a1',
                    'price' => (int) $jumlah,
                    'quantity' => 1,
                    'name' => 'PEMBAYARAN KAS',
                )
            );

            $customer_details = array(
                'first_name' => $nama,
                'last_name' => $noreg,
                'email' => member_login()->email,
                'phone' => member_login()->telp,
            );

            $enable_payments = array('mandiri_clickpay', 'echannel', 'gopay', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'permata_va', 'bni_va', 'other_va', 'shopeepay');

            // Add finish_redirect_url
            $finish_redirect_url = getBaseUrl() . 'midtrans/webhook';

            $transaction = array(
                'transaction_details' => $transaction_details,
                'enabled_payments' => $enable_payments,
                'item_details' => $item_details,
                'customer_details' => $customer_details
            );

            try {
                $snapToken = Snap::getSnapToken($transaction);

                $create = [
                    'judul' => $judul,
                    'member_id' => member_login()->id,
                    'jumlah' => $jumlah,
                    'payment_type' => $_POST['jenis'],
                    'type' => $_POST['type'],
                    'status' => 0,
                    'keterangan' => $_POST['keterangan'],
                    'date' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'input_by' => $_SESSION['login_member'],
                    'snap_token' => $snapToken
                ];
                $transaction = Datmid::create($create);
                echo json_encode(['snapToken' => $snapToken]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }


    public function coreapi()
    {

        $number = 6285882620035;

        $params = array(
            "payment_type" => "gopay",
            "gopay_partner" => array(
                "phone_number" => $number,
                "redirect_url" => "https://www.google.com"
            )
        );

        $response = '';

        $response = '';
        try {
            $response = CoreApi::linkPaymentAccount($params);


            echo "<h2>Hasil pay account:</h2>";
            echo json_encode($response, JSON_UNESCAPED_SLASHES);
            echo "<br>";
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
