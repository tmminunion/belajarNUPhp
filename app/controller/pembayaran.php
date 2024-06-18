<?php

use App\Model\member;
use App\Core\Controller;
use App\Model\PaymentType;
use App\Model\transaction;

class pembayaran extends Controller
{
     public $auth = true;
     public $role = [1];

     public function __construct()
     {
          parent::__construct(); // Memanggil konstruktor dari kelas induk
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $this->cekpost();
          }
     }
     public function index()
     {
          last_form();
          $data["title"] = tanggal_sekarang();
          $data["member"] = member::all();
          $data["paymentType"] = PaymentType::all();
          View("pembayaran/index", $data);
     }
     public function addtype()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
          }
     }
     public function create()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               vPost(['member_id', 'jenis', 'keterangan']);

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

               transaction::create($create);

               // Redirect to a success page
               to_url("transaksi");
               exit;
          }
     }
}
