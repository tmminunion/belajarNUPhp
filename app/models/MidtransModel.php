<?php

namespace App\Models;

use Midtrans\Config;
use Midtrans\Transaction;

class MidtransModel
{
    public function __construct()
    {
        // Set Your server key
        Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        Config::$clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;
    }

    public static function getStatus($orderId)
    {
        Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        Config::$clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

        try {
            // Memanggil fungsi status dari Midtrans dengan menggunakan order_id
            $status = Transaction::status($orderId);
            return $status;
        } catch (Exception $e) {
            // Menangani jika ada kesalahan
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }
}
?>
