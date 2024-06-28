<?php

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

use App\Model\member;
use App\Model\PaymentType;
use App\Core\Controller;
use App\Models\MidtransModel;
use App\Model\Midtran as Datmid;

class pembayaran extends Controller
{
    public $auth = true;

    public function __construct()
    {
        $model = new MidtransModel;
    }
    public function index($d = 'kas', $donid = null)
    {
        last_form();
        $data["clientKey"] = $_ENV['MIDTRANS_CLIENT_KEY'];
        $data["title"] = tanggal_sekarang();
        $data["member"] = member::all();
        $data["paymentType"] = PaymentType::all();
        $data["jenis"] = $d;
        $data["type"] = 'kredit';
        $data["judultype"] = 'Pembayaran';
        $data["donid"] = $donid;
        View("pembayaran/midtrans", $data);
    }
    public function post()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['Nama'];
            $noreg = $_POST['Noreg'];
            $jumlah = str_replace('Rp. ', '', $_POST['jumlah']);
            $jumlah = str_replace('.', '', $jumlah);
            $keterangan = $_POST['keterangan'];
            $payment_method = $_POST['payment_method'];
            $jenis = $_POST['jenis'];
            $judul = midNumber($jenis);
            $transaction_details = array(
                'order_id' => $judul,
                'gross_amount' => (int) $jumlah,
            );

            $item_details = array(
                array(
                    'id' => ridNumber(),
                    'price' => (int) $jumlah,
                    'quantity' => 1,
                    'name' => $keterangan,
                    'brand' => "UB ASSY",
                    'category' => "DONASI",
                    'merchant_name' => "UNDERBODY ASSY"
                )
            );

            $customer_details = array(
                'first_name' => $nama,
                'last_name' => $noreg,
                'email' => member_login()->email,
                'phone' => member_login()->telp,
            );
            // 
            $enable_payments = array('cimb_clicks', 'mandiri_clickpay', 'echannel', 'gopay', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'permata_va', 'bni_va', 'other_va', 'shopeepay');

            $transaction = array(
                'transaction_details' => $transaction_details,
                'enabled_payments' => $enable_payments,
                'item_details' => $item_details,
                'customer_details' => $customer_details,
            );



            try {
                $snapToken = Snap::getSnapToken($transaction);
                $create = [
                    'judul' => $judul,
                    'member_id' => member_login()->id,
                    'jumlah' => $jumlah,
                    'payment_type' => 3,
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

            //     

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
    public function deep()
    {


        $nama = 'nufat';
        $noreg = 'dodol';
        $ddd = 100000;
        $jumlah = str_replace('Rp. ', '', $ddd);
        $jumlah = str_replace('.', '', $jumlah);
        $keterangan = 'bayar jiii';
        $payment_method = 'gopay';
        $jenis = 'KAS';

        $transaction_details = array(
            'order_id' => uniqid(),
            'gross_amount' => (int) $jumlah,
        );

        $item_details = array(
            array(
                'id' => 'a1',
                'price' => (int) $jumlah,
                'quantity' => 1,
                'name' => $keterangan,
            )
        );

        $customer_details = array(
            'first_name' => $nama,
            'last_name' => $noreg,
            'email' => 'customer@example.com',
            'phone' => '08111222333',
        );

        $transaction = array(
            'payment_type' => 'gopay',
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'gopay' => array(
                'enable_callback' => true,
                'callback_url' => 'https://underbody.nufat.id/midtrans/webhook', // Replace with your actual callback URL
            ),
        );

        try {
            $response = \Midtrans\CoreApi::charge($transaction);
            $deeplinkUrl = $response;
            echo json_encode(['deeplinkUrl' => $deeplinkUrl]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
