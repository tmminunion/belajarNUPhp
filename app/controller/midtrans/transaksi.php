<?php

use Midtrans\Config;
use Midtrans\Transaction;
use App\Models\MidtransModel;
use App\Model\Midtran;
class Transaksi
{
    private $model;

    public function __construct()
    {
        // Inisialisasi model MidtransModel
        $this->model = new MidtransModel();
    }

    public function index($orderId)
    {
      try {
         $data = MidtransModel::getStatus($orderId);
    res(200,$data);
      } catch (Exception $e) {
        $data["status"] = "eror";
        res(400,$data);
      }
   
    }
 public function check($orderId)
    {
        try {
            $data = MidtransModel::getStatus($orderId);
            // Lakukan sesuatu dengan data, misalnya menampilkannya atau menyimpannya di database
             to_url('midtrans/snaplist');
        } catch (Exception $e) {
            // Menghapus entri berdasarkan judul jika terjadi pengecualian
            Midtran::where('judul', $orderId)->delete();
         to_url('midtrans/snaplist');
        }
    }
}
?>
