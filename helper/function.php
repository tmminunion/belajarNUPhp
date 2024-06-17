<?php

use App\Model\member;
use App\Model\Transaction;

use App\Model\PaymentType;
use Carbon\Carbon;

function KasNumber($typeId)
{
    $paymentType = PaymentType::find($typeId);
    if (!$paymentType) {
        return "Type not found";
    }

    $typeCode = strtoupper(substr($paymentType->name, 0, 3)); // Mengambil 3 huruf pertama dari nama jenis pembayaran
    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');

    // Mencari nomor urut terakhir untuk jenis pembayaran tertentu pada bulan dan tahun saat ini
    $lastKasNumber = Transaction::where('judul', 'like', $typeCode . $year . $month . '%')->count() + 1;

    // Menghasilkan nomor KAS dengan format yang diinginkan
    $kasNumber = $typeCode . $year . $month . str_pad($lastKasNumber, 4, '0', STR_PAD_LEFT);

    return $kasNumber;
}



function isLogin()
{
    if (isset($_SESSION['login'])) {
        return true;
    }
}
function member_login()
{
    if (isLogin()) {
        $memberId = $_SESSION['login_member'];
        $member = Member::find($memberId);
        return $member;
    } else {
        return false;
    }
}
function mylogin()
{
    if (isLogin()) {
        $memberId = $_SESSION['login_member'];
        return $memberId;
    } else {
        return false;
    }
}
function generateUID($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isRole($v)
{
    // Pastikan $_SESSION['login_role'] sudah di-set
    if (isset($_SESSION['login_role'])) {
        // Jika $v adalah array
        if (is_array($v)) {
            // Memeriksa apakah $_SESSION['login_role'] ada dalam array $v
            if (in_array($_SESSION['login_role'], $v)) {
                return true;
            } else {
                return false;
            }
        } else { // Jika $v adalah nilai tunggal
            // Bandingkan nilai $_SESSION['login_role'] dengan $v
            if ($_SESSION['login_role'] == $v) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        // Jika $_SESSION['login_role'] belum di-set, kembalikan false
        return false;
    }
}

function isActive($page)
{
    // Menggunakan $_SERVER['REQUEST_URI'] untuk mendapatkan URI yang diminta pengguna
    // dan menggunakan strpos() untuk memeriksa apakah URI yang diminta mengandung string $page
    return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active' : '';
}
