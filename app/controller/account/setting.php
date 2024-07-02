<?php

use App\Core\Controller;
use App\Model\User;
class setting extends Controller
{
  public $auth = true;
  public function index()
  {
  $user = User::find($_SESSION['login']);
    View("profil/akunsett", $user);
  }
  
  public function updatePassword()
    {
      
        if (!isset($_SESSION['login'])) {
            header('Location: = '.getBaseUrl() .'account/setting');
            exit();
        }

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['new_password_confirmation'];

        if ($new_password !== $confirm_password) {
            $_SESSION['error'] = 'Password baru dan konfirmasi password tidak cocok.';
            header('Location: '.getBaseUrl() .'account/setting');
            exit();
        }

        $user = User::find($_SESSION['login']);
        if (!password_verify($current_password, $user->password_hash)) {
            $_SESSION['error'] = 'Password lama salah.';
           header('Location: = '.getBaseUrl() .'account/setting');
            exit();
        }
 $options = [
            'cost' => 10,
        ];
        $user->password_hash = password_hash($new_password, PASSWORD_BCRYPT, $options);
        $user->save();

        $_SESSION['status'] = 'Password berhasil diubah.';
        header('Location: = '.getBaseUrl() .'account/setting');
    }
  
  
}