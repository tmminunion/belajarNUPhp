<?php

use App\Model\Cerit;
use App\Model\Tabung;
use App\Model\transaction;
use App\Models\invoiceModel;

class pdfkredit extends invoiceModel
{
    public function donasi($id)
    {
        // Fetch data from the database
        $data["mod"] = Cerit::with(['member', 'inputBy', 'donasi'])->find($id);
        $data["title"] = "Kredit";

        // Generate QR code as base64
        $data['base64'] = $this->textcode();
        // Capture the output of the view
        $this->pdfrender('invoice/simplepdf', $data);
    }
    public function tabungan($id)
    {
        $data["mod"] = Tabung::with(['member', 'inputBy'])->find($id);
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Tabungan Underbody';
        $data['base64'] = $this->textcode();
        $this->pdfrender('invoice/pdftabung', $data);
    }
    public function kas($id)
    {
        $data["mod"] = transaction::with(['member', 'inputBy'])->find($id);
        $data["title"] = "Kredit";
        $data["urlcurrent"] = getCurrentUrl();
        $data["title"] = 'Setoran Kas Bulanan Underbody';
        $data['base64'] = $this->textcode();
        $this->pdfrender('invoice/pdftabung', $data);
    }

    public function textcode()
    {
        $encodedUrl = getCurrentUrl();
        $text = decodeUrl($encodedUrl);
        $size = 12; // Ukuran gambar QR code
        $errorCorrectionLevel = "L"; // Level koreksi kesalahan (L, M, Q, H)
        $margin = 1; // Margin di sekeliling QR code
        $moduleSize = 1; // Ukuran modul QR code

        // Menggunakan nilai default jika $text kosong
        $text = empty($text) ? "https://bungtemin.net" : $text;

        // Generate QR code
        ob_start();
        QRcode::png(
            $text,
            false,
            $errorCorrectionLevel,
            $size,
            $margin,
            false,
            0xffffff,
            0x000000,
            $moduleSize
        );
        $imageData = ob_get_contents();
        ob_end_clean();

        // Encode image data in base64
        $base64 = base64_encode($imageData);

        return $base64;
    }
}
