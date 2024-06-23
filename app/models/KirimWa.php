<?php

namespace App\Models;

use App\Model\Cerit;
use App\Model\Tabung;
use GuzzleHttp\Client;
use App\Model\transaction;

class KirimWa
{
    public static function kirim_kas($id)
    {
        $client = new Client();
        $data = transaction::with(['member', 'inputBy'])->find($id);
        $data1 = [
            'PostID' => $data->judul,
            'Telp' => $data->member->telp,
            'base64PDF' => getBaseUrl() . "invoice/pdfkredit/kas/" . $id . "/invoice.pdf",
            'link' => getBaseUrl() . "invoice/kredit/kas/" . $id
        ];

        $headers = [
            'apikey' => 'Nurani110' // Sesuaikan dengan format autentikasi yang digunakan oleh API
        ];

        $url1 = 'https://bungtemin.net/invoice/PostData'; // Ganti dengan URL endpoint Node.js Anda

        $response = $client->request('POST', $url1, [
            'headers' => $headers,
            'json' => $data1
        ]);
    }
    public static function kirim_tabungan($id)
    {
        $client = new Client();
        $data = Tabung::with(['member', 'inputBy'])->find($id);
        $data1 = [
            'PostID' => $data->judul,
            'Telp' => $data->member->telp,
            'base64PDF' => getBaseUrl() . "invoice/pdfkredit/tabungan/" . $id . "/invoice.pdf",
            'link' => getBaseUrl() . "invoice/kredit/tabungan/" . $id
        ];

        $headers = [
            'apikey' => 'Nurani110' // Sesuaikan dengan format autentikasi yang digunakan oleh API
        ];

        $url1 = 'https://bungtemin.net/invoice/PostData'; // Ganti dengan URL endpoint Node.js Anda

        $response = $client->request('POST', $url1, [
            'headers' => $headers,
            'json' => $data1
        ]);
    }
    public static function kirim_donasi($id)
    {
        $client = new Client();
        $data = Cerit::with(['member', 'inputBy'])->find($id);
        $data1 = [
            'PostID' => $data->judul,
            'Telp' => $data->member->telp,
            'base64PDF' => getBaseUrl() . "invoice/pdfkredit/donasi/" . $id . "/invoice.pdf",
            'link' => getBaseUrl() . "invoice/kredit/donasi/" . $id
        ];

        $headers = [
            'apikey' => 'Nurani110' // Sesuaikan dengan format autentikasi yang digunakan oleh API
        ];

        $url1 = 'https://bungtemin.net/invoice/PostData'; // Ganti dengan URL endpoint Node.js Anda

        $response = $client->request('POST', $url1, [
            'headers' => $headers,
            'json' => $data1
        ]);
    }
}
