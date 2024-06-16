<?php
class transaksiModel
{
     public function getSaldo($member_id)
     {
          $saldo = DB::table('transactions')
               ->selectRaw('
            SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) AS total_kredit,
            SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END) AS total_debit,
            (SUM(CASE WHEN type = "kredit" THEN jumlah ELSE 0 END) - SUM(CASE WHEN type = "debit" THEN jumlah ELSE 0 END)) AS saldo_akhir
        ')
               ->where('member_id', $member_id)
               ->first();

          return $saldo;
     }
}
