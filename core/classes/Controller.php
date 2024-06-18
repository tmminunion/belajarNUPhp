<?php

namespace App\Core;

use App\Core\Auth;



class Controller
{

    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $_SESSION['oldpage'] = $_SERVER['REQUEST_URI'];
        }
        if (isset($this->auth)) {
            $this->auth($this->auth);
        }
        if (isset($this->role)) {
            $this->roles($this->role);
        }
    }
    protected function auth($by)
    {
        $auth = new Auth($by);
    }
    public function roles($v)
    {
        if (!isset($_SESSION['login_role'])) {
            header("location: " . getBaseUrl());
            exit();
        }

        // Jika $v adalah array
        if (is_array($v)) {
            if (!in_array($_SESSION['login_role'], $v)) {
                header("location: " . getBaseUrl());
                exit();
            }
        } else { // Jika $v adalah nilai tunggal
            if ($_SESSION['login_role'] != $v) {
                header("location: " . getBaseUrl());
                exit();
            }
        }
    }
    public function cekpost()
    {
        $last = get_last_form();
        if (!$this->checkCsrf($_POST['csrf'])) {
            if (isset($last)) {
                header("Location: " . $last . "?error=csrf");
            } else {
                header("location: " . getBaseUrl() . "?error=csrf");
            }
            exit;
        }
    }
    public function checkCsrf($token)
    {
        if (isset($_SESSION['token_csrf']) && $_SESSION['token_csrf'] == $token) {
            return true;
        } else {
            return false;
        }
    }

    public function model($m)
    {
        require_once 'app/models/' . $m . '.php';
        return new $m;
    }
    public function cont($m)
    {
        require_once 'app/controller/' . $m . '.php';
        return new $m;
    }
}
