<?php

use Midtrans\Config;
use Midtrans\Transaction;
use App\Models\MidtransModel;

class Transaksi
{
    private $model;

    public function __construct()
    {
        // Load konfigurasi Midtrans
   

        // Inisialisasi model MidtransModel
        $this->model = new MidtransModel();
    }

    public function index($orderId)
    {
    $data = MidtransModel::getStatus($orderId);
    res(200,$data);
    }
}
?>
