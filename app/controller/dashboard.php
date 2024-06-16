<?php

use App\Model\transaction;
use App\Model\member;

class dashboard extends Controller
{

     public function index()
     {
          $totals = Transaction::selectRaw('
        SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
        (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
    ')->first();

          $total_kredit = $totals->total_kredit;
          $total_debit = $totals->total_debit;
          $rasio_kredit_debit = ($total_debit > 0) ? round(($total_debit / $total_kredit) * 100) : 100;

          $currentMonth = date('m');
          $currentYear = date('Y');

          $totalsbulan = Transaction::selectRaw('
        SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
        (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
    ')
               ->whereMonth('date', $currentMonth)
               ->whereYear('date', $currentYear)
               ->first();


          $total_members = Member::count();

          // Menghitung saldo per anggota
          $saldo_per_anggota = ($total_members > 0) ? round($totals->saldo_akhir / $total_members) : 0;
          $anggotabulan = ($total_members > 0) ? round($totalsbulan->saldo_akhir / $total_members) : 0;


          $totalKreditPerBulan = transaction::selectRaw(
               'SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
        MONTH(date) AS bulan'
          )
               ->whereDate('date', '>=', date('Y-m-d', strtotime('-6 months'))) // Ambil data mulai dari 6 bulan terakhir
               ->groupBy('bulan')
               ->orderBy('bulan')
               ->get();

          $labels = [];
          $datak = [];

          foreach ($totalKreditPerBulan as $item) {
               $labels[] = \DateTime::createFromFormat('!m', $item->bulan)->format('M');
               $datak[] = $item->total_kredit;
          }

          $totalSaldoPerBulan = transaction::selectRaw('
    SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_saldo,
    DATE_FORMAT(date, "%b") AS bulan,
    MONTH(date) AS bulan_num
')
               ->whereRaw('DATE_FORMAT(date, "%Y-%m") >= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 8 MONTH), "%Y-%m")')
               ->groupBy('bulan', 'bulan_num')
               ->orderBy('bulan_num')
               ->get();


          $labelsaldo = [];
          $saldoPerBulan = [];

          foreach ($totalSaldoPerBulan as $item) {
               $labelsaldo[] = $item->bulan;
               $saldoPerBulan[] = $item->total_saldo;
          }



          // Menggunakan compact untuk mengirimkan variabel ke view
          $data = compact('totalsbulan', 'totals', 'rasio_kredit_debit', 'saldo_per_anggota', 'anggotabulan', 'labels', 'datak', 'labelsaldo', 'saldoPerBulan');

          View('dashboard/index', $data);
     }
}
