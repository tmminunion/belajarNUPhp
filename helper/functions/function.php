<?php

use App\Model\member;
use App\Model\transaction;

use App\Model\PaymentType;
use Carbon\Carbon;

/**
 * Menghasilkan nomor Kas berdasarkan ID tipe pembayaran dan jenisnya.
 *
 * @param int $typeId ID tipe pembayaran.
 * @param string $jenis Jenis nomor Kas.
 * @return string Nomor Kas yang dihasilkan.
 */

function generateKasNumber($typeId)
{
    $paymentType = PaymentType::find($typeId);

    if (!$paymentType) {
        return "Tipe tidak ditemukan";
    }

    $typeCode = strtoupper(substr($paymentType->name, 0, 3));

    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');

    $lastKasNumber = transaction::where('judul', 'like', $typeCode . $year . $month . '%')
        ->count();

    $kasNumber = $typeCode . $year . $month . str_pad($lastKasNumber + 1, 4, '0', STR_PAD_LEFT);

    return $kasNumber;
}

function KasNumber($typeId, $jenis)
{
    $faker = \Faker\Factory::create('id_ID');
    $currentDate = Carbon::now();
    $month = $currentDate->format('m');
    $year = $currentDate->format('y');

    if ($jenis == 'kas') {
        $kasNumber = generateKasNumber($typeId);
    } elseif ($jenis == 'tabungan') {
        $kasNumber = $year . $faker->regexify('[A-Z]{3}[0-9]{5}') . $month;
    } elseif ($jenis == 'donasi') {
        $kasNumber = $faker->regexify('[A-Z]{3}[0-9]{7}') . $month . $year;
    } else {
        return $faker->swiftBicNumber();
    }

    return $kasNumber;
}

/**
 * Periksa apakah pengguna telah login.
 *
 * @return bool Mengembalikan true jika pengguna telah login, false jika tidak.
 */
function isLogin()
{
    // Periksa apakah variabel sesi 'login' telah diatur
    if (isset($_SESSION['login'])) {
        // Jika telah diatur, kembalikan true untuk menunjukkan bahwa pengguna telah login
        return true;
    }

    // Jika variabel sesi 'login' tidak diatur, kembalikan false
    return false;
}

/**
 * Periksa apakah pengguna telah login sebagai anggota dan kembalikan objek anggota jika ya, jika tidak kembalikan false.
 *
 * @return mixed Mengembalikan objek anggota jika pengguna telah login, jika tidak kembalikan false.
 */
function member_login()
{
    // Periksa apakah variabel sesi 'login_member' telah diatur
    if (isLogin()) {
        // Jika telah diatur, dapatkan ID anggota dari sesi
        $memberId = $_SESSION['login_member'];

        // Temukan anggota menggunakan ID anggota
        $member = member::find($memberId);

        // Kembalikan objek anggota
        return $member;
    } else {
        // Jika variabel sesi 'login_member' tidak diatur, kembalikan false
        return false;
    }
}

/**
 * Mengambil jabatan anggota yang telah login.
 *
 * @return mixed|false Jabatan anggota jika telah login, false jika tidak.
 */
function my_job()
{
    // Periksa apakah pengguna telah login
    if (isLogin()) {
        // Dapatkan ID anggota dari sesi
        $memberId = $_SESSION['login_member'];

        // Temukan anggota menggunakan ID anggota
        $member = member::find($memberId);

        // Dapatkan jabatan anggota berdasarkan atribut jabatan mereka
        $job = getMemberJob($member->job);

        // Kembalikan jabatan anggota
        return $job;
    }

    // Jika pengguna tidak login, kembalikan false
    return false;
}

/**
 * Mengambil ID anggota yang telah login.
 *
 * @return mixed|false ID anggota jika telah login, false jika tidak.
 */
function mylogin()
{
    // Periksa apakah pengguna telah login
    if (isLogin()) {
        // Dapatkan ID anggota dari sesi
        $memberId = $_SESSION['login_member'];

        // Kembalikan ID anggota
        return $memberId;
    } else {
        // Jika pengguna tidak login, kembalikan false
        return false;
    }
}

/**
 * Mengambil jabatan anggota berdasarkan atribut jabatan mereka.
 *
 * @param string $job Atribut jabatan anggota.
 * @return string Jabatan yang sesuai dengan atribut jabatan.
 */
function getMemberJob($job)
{
    // Tentukan pemetaan atribut jabatan ke jabatan
    $jobs = [
        "TL" => "TEAM LEADER", // Team Leader
        "TM" => "TEAM MEMBER", // Team Member
        "GL" => "GROUP LEADER" // Group Leader
    ];

    // Kembalikan jabatan yang sesuai dengan atribut jabatan
    return $jobs[$job];
}

/**
 * Memeriksa apakah peran pengguna cocok dengan nilai yang diberikan.
 *
 * @param mixed $v Nilai atau array nilai untuk dibandingkan dengan peran pengguna.
 * @return bool Mengembalikan true jika peran pengguna cocok dengan salah satu nilai yang diberikan, false jika tidak.
 */
function isRole($v)
{
    // Periksa apakah variabel sesi 'login_role' telah diatur
    if (isset($_SESSION['login_role'])) {
        // Jika $v adalah array, periksa apakah 'login_role' ada di array
        if (is_array($v)) {
            // Periksa apakah 'login_role' ada di array
            if (in_array($_SESSION['login_role'], $v)) {
                return true;
            } else {
                return false;
            }
        } else { // Jika $v adalah nilai tunggal
            // Bandingkan 'login_role' dengan nilai
            if ($_SESSION['login_role'] == $v) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        // Jika 'login_role' tidak diatur, kembalikan false
        return false;
    }
}

/**
 * Memeriksa apakah URI yang diminta berisi halaman yang diberikan.
 *
 * Fungsi ini menggunakan variabel $_SERVER['REQUEST_URI'] untuk mendapatkan URI yang diminta
 * dan membandingkannya dengan halaman yang diberikan menggunakan fungsi strpos(). Ia mengembalikan 'active'
 * jika halaman ditemukan di URI, jika tidak ia mengembalikan string kosong.
 *
 * @param string $page Halaman untuk diperiksa di URI.
 * @return string Mengembalikan 'active' jika halaman ditemukan di URI, jika tidak string kosong.
 */
function isActive($page)
{
    // Periksa apakah URI yang diminta berisi halaman yang diberikan
    // Menggunakan $_SERVER['REQUEST_URI'] untuk mendapatkan URI yang diminta
    // dan strpos() untuk memeriksa apakah URI berisi halaman
    return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active' : '';
}
