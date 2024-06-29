<?php

namespace App\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class WebhookWa
{
    private static $endpoint = 'http://localhost:8000/send'; // Ganti dengan URL endpoint Node.js Anda
    private static $apiKey = 'Nurani110'; // Sesuaikan dengan format autentikasi yang digunakan oleh API

    public static function kirim_notifadmin($data)
    {
        $client = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'number',
                    'contents' => '085882620035'
                ],
                [
                    'name' => 'message',
                    'contents' => $data
                ]
            ]
        ];
        $request = new Request('POST', self::$endpoint);
        $res = $client->sendAsync($request, $options)->wait();
    }
}
