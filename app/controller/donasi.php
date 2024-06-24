<?php

use App\Model\Cerit;
use App\Model\member;
use App\Core\Controller;
use App\Model\Don;

class donasi extends Controller
{
     public function index()
     {


          $page = 1;
          $perPage = 30;
          $offset = ($page - 1) * $perPage;
          $transactions = Cerit::orderBy('date', 'desc')
               ->skip($offset)
               ->take($perPage)
               ->get();

          return View('transaksi/index', [
               'transactions' => $transactions,
               'currentPage' => $page,
               'perPage' => $perPage,
          ]);
     }
     public function daftar($id, $slug)
     {
          $members = member::with('Donasi')->get();
          $don =  Don::find($id);
          $own_id = $don->member_id;
          $memberlogin = member_login();
          $data["myown"] = false;
          if ($memberlogin) {
               if ($memberlogin->id == $own_id) {
                    $data["myown"] = true;
               }
          }
          // Inisialisasi array untuk menyimpan saldo tiap member
          $memberSaldo = [];
          $totalSaldo = Cerit::where('don_id', $id)->sum('jumlah');
          foreach ($members as $member) {
               $memberSaldo[] = [
                    'id' => $member->id,
                    'member_id' => $member->id,
                    'nama' => strnama($member->nama), // pastikan ada kolom 'name' atau sesuaikan dengan kolom yang ada
                    'saldo' => $member->getDonasi($id),
                    'noreg' => $member->noreg,
                    'gambar' => $member->gambar,
               ];
          }
          $data["data"] = $memberSaldo;
          $data["totalSaldo"] = $totalSaldo;
          $data["don"] = $don;
          View("member/donasi", $data);
     }
}
