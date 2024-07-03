<?php

use App\Core\Controller;
use App\Model\User;
use App\Core\Email;

class action extends Controller
{
   

    public function index()
    {
      
    }
    public function activateEmail()
    {
        if (!isset($_GET['token'])) {
            $_SESSION['error_update_email'] = 'Token aktivasi tidak valid.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $token = $_GET['token'];
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            $_SESSION['error_update_email'] = 'Token aktivasi tidak valid.';
            header('Location: ' . getBaseUrl() . 'account/setting');
            exit();
        }

        $user->active_email = 1;
        $user->activation_token = null;
        $user->save();

        $_SESSION['status_update_email'] = 'Email Anda telah berhasil diaktifkan.';
        header('Location: ' . getBaseUrl() . 'account/setting');
        exit();
    }
}
