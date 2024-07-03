<?php
use App\Core\Email as Kirim;

class email
{

    public function index()
    {
        $new_email = 'nufat17@gmail.com';
        $subject = 'test dari nu php';
        $message = 'ini adalah pesan dari nuPHP';

        $email = new Kirim();
        $emailSent = $email->sendMail($new_email, $subject, $message);

        if ($emailSent) {
            $_SESSION['status_update_email'] = 'Email berhasil diubah. Silakan cek email Anda untuk mengaktifkan email baru.';
        } else {
            $_SESSION['error_update_email'] = 'Gagal mengirim email aktivasi.';
        }

        // Outputkan hasil untuk debugging
        if (isset($_SESSION['status_update_email'])) {
            echo "Status: " . $_SESSION['status_update_email'];
        }
        if (isset($_SESSION['error_update_email'])) {
            echo "Error: " . $_SESSION['error_update_email'];
        }
    }
}
