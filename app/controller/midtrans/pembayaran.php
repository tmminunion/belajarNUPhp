<?php

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;

use App\Model\member;
use App\Model\PaymentType;
use App\Core\Controller;

class pembayaran extends Controller
{
   public $auth =true;
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
    public function post_kas()
     {
    // Set Your server key
        Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['Nama'];
    $noreg = $_POST['Noreg'];
    $jumlah = str_replace('Rp. ', '', $_POST['jumlah']);
    $jumlah = str_replace('.', '', $jumlah);
    $keterangan = $_POST['keterangan'];
    $payment_method = $_POST['payment_method'];
    $jenis = $_POST['jenis'];

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
        'email' => member_login()->email,
        'phone' => member_login()->telp,
    );
    // 
  $enable_payments = array('cimb_clicks', 'mandiri_clickpay', 'echannel', 'gopay', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'permata_va', 'bni_va', 'other_va', 'shopeepay');
  
    $transactionTT = array(
        'transaction_details' => $transaction_details,
         'enabled_payments' => $enable_payments,
        'item_details' => $item_details,
        'customer_details' => $customer_details,
    );

    $transaction = array(
        'transaction_details' => $transaction_details,
        'item_details' => $item_details,
        'customer_details' => $customer_details,
    );
    
    try {
        $snapToken = Snap::getSnapToken($transaction);
        echo json_encode(['snapToken' => $snapToken]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

//     
    
}
     }
     
     public function coreapi()
     {
              Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;
        $number =6285882620035;
     
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
       // pembayaran_post.php

  Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

    $nama = 'nufat';
    $noreg = 'dodol';
    $ddd=100000;
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
?>