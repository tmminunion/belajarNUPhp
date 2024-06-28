<?php

namespace App\Models;


use GuzzleHttp\Client;
use App\Model\Midtran as transaction;

class WebhookWa
{
    private static $endpoint = 'https://bungtemin.net/invoice/PostData'; // Ganti dengan URL endpoint Node.js Anda
    private static $apiKey = 'Nurani110'; // Sesuaikan dengan format autentikasi yang digunakan oleh API

    public static function kirim_notifadmin($id)
    {
        $client = new Client();
        $data = transaction::with(['member'])->find($id);

        $headers = ['apikey' => self::$apiKey];

        $response = $client->request('POST', self::$endpoint, [
            'headers' => $headers,
            'json' => $data
        ]);
    }
}
