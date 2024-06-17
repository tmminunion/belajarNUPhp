<?php

use App\Model\member;
use App\Model\Transaction;
use App\Model\PaymentType;

class pembayaran extends Controller
{
     public $auth = true;
     public $role = [1];
     public function index()
     {
          $data["member"] = member::all();
          $data["paymentType"] = PaymentType::all();
          View("pembayaran/index", $data);
     }

     public function create()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {

               if (!$this->checkCsrf($_POST['csrf'])) {
                    echo "Invalid CSRF token";
                    header("Location: " . getBaseUrl() . "pembayaran/index?error=Invalid CSRF token");
                    exit;
               }


               $jumlah = str_replace(['Rp. ', '.'], '', $_POST['jumlah']); // Remove formatting before inserting
               $create = [
                    'judul' => KasNumber($_POST['jenis']),
                    'member_id' => $_POST['member_id'],
                    'jumlah' => $jumlah,
                    'payment_type' => $_POST['jenis'],
                    'type' => 'kredit',
                    'keterangan' => $_POST['keterangan'],
                    'date' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'input_by' => $_SESSION['login_member'],
               ];

               var_dump($create);

               Transaction::create($create);

               // Redirect to a success page
               header("Location: " . getBaseUrl() . "transaksi");
               exit;
          }
     }
}
