<?php

use App\Core\Email as Kirim;
use GuzzleHttp\Client;
class emailsender
{
    public function index()
    {
        $new_email = 'nufat17@gmail.com';
        $subject = 'Invoice PDF';
        $message = 'Please find attached the PDF invoice.';

        // URL to the PDF file
        $pdfUrl = 'http://localhost:8005/invoice/pdfkredit/kas/KAS24070002';

        // Download the PDF file
        $tempFilePath = $this->downloadFileWithGuzzle($pdfUrl);
        

        // Sending email with attachment
        if ($tempFilePath !== false) {
            $email = new Kirim();
            $emailSent = $email->sendMailWithAttachment($new_email, $subject, $message, [$tempFilePath]);

            if ($emailSent) {
                $_SESSION['status_update_email'] = 'Email dengan lampiran PDF berhasil dikirim.';
            } else {
                $_SESSION['error_update_email'] = 'Gagal mengirim email dengan lampiran PDF.';
            }

            // Clean up: delete temporary file after sending email
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        } else {
            $_SESSION['error_update_email'] = 'Gagal mengunduh file PDF dari URL.';
        }

        // Outputkan hasil untuk debugging
        if (isset($_SESSION['status_update_email'])) {
            echo "Status: " . $_SESSION['status_update_email'];
        }
        if (isset($_SESSION['error_update_email'])) {
            echo "Error: " . $_SESSION['error_update_email'];
        }
    }

   private function downloadFileWithGuzzle($url)
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'pdf_');
        $client = new Client();

        try {
            $response = $client->get($url, ['sink' => $tempFilePath]);

            if ($response->getStatusCode() === 200) {
                return $tempFilePath;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}

