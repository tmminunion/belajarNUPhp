<?php

use App\Model\Transaction;
use App\Model\Member;

class dashboard extends Controller
{
     public $auth = false;

     public function index()
     {
          $totals = Transaction::selectRaw('
SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
(SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
')->first();

          $total_kredit = $totals->total_kredit;
          $total_debit = $totals->total_debit;
          $rasio_kredit_debit = ($total_kredit > 0) ? round(($total_debit / $total_kredit) * 100) : 100;

          $currentMonth = date('m');
          $currentYear = date('Y');

          $totalsbulan = Transaction::selectRaw('
SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
(SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
')
               ->whereRaw("strftime('%m', date) = ?", [$currentMonth])
               ->whereRaw("strftime('%Y', date) = ?", [$currentYear])
               ->first();

          $total_members = Member::count();

          // Menghitung saldo per anggota
          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;
          $anggotabulan = ($total_members > 0) ? round($totalsbulan->saldo_akhir / $total_members) : 0;

          $totalKreditPerBulan = Transaction::selectRaw(
               'SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
strftime("%m", date) AS bulan'
          )
               ->whereRaw("date >= date('now', '-6 months')")
               ->groupBy('bulan')
               ->orderBy('bulan')
               ->get();

          $labels = [];
          $datak = [];

          foreach ($totalKreditPerBulan as $item) {
               $labels[] = date('M', mktime(0, 0, 0, $item->bulan));
               $datak[] = $item->total_kredit;
          }

          $totalSaldoPerBulan = Transaction::selectRaw('
    SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_saldo,
    strftime("%Y-%m", date) AS bulan
')
               ->whereRaw("date >= date('now', '-8 months')")
               ->groupBy('bulan')
               ->orderBy('bulan')
               ->get();

          $labelsaldo = [];
          $saldoPerBulan = [];

          foreach ($totalSaldoPerBulan as $item) {
               // Extract month and year from the bulan field
               $bulanYear = explode('-', $item->bulan);
               $monthName = date("M", mktime(0, 0, 0, $bulanYear[1], 1));

               $labelsaldo[] = $monthName;
               $saldoPerBulan[] = $item->total_saldo;
          }


          $memberIdsWithKredit = Transaction::where('type', 'kredit')
               ->where('status', 1)
               ->whereRaw("strftime('%m', date) = ?", [$currentMonth])
               ->whereRaw("strftime('%Y', date) = ?", [$currentYear])
               ->pluck('member_id')
               ->toArray();

          // Mendapatkan semua anggota yang belum melakukan transaksi kredit dengan status 1 pada bulan ini
          $membersWithoutKredit = Member::whereNotIn('id', $memberIdsWithKredit)->get();
          $utKredit = $membersWithoutKredit->count();

          // Jika jumlah data yang ditemukan kurang dari lima, tetap ambil lima data terbaru
          $latest = Transaction::latest()->take($utKredit < 5 ? 5 : $utKredit - 2)->get();

          // Menggunakan compact untuk mengirimkan variabel ke view
          $data = compact('membersWithoutKredit', 'latest', 'totalsbulan', 'totals', 'rasio_kredit_debit', 'saldo_per_anggota', 'anggotabulan', 'labels', 'datak', 'labelsaldo', 'saldoPerBulan');

          View('dashboard/index', $data);
     }
}
