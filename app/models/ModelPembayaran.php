<?php

namespace App\Models;

use App\Model\Tabung;
use App\Model\Cerit;
use App\Model\Midtran;
use App\Model\Transaction;

class ModelPembayaran
{
     public static function index($data)
     {
          $ambilmid = Midtran::where('judul', $data)->first();
          $prefix = substr($data, 0, 3);
          $datain = [
               'judul' => $ambilmid->judul,
               'member_id' => $ambilmid->member_id,
               'jumlah' => $ambilmid->jumlah,
               'payment_type' => $ambilmid->payment_type,
               'type' => $ambilmid->type,
               'status' => 0,
               'keterangan' => $ambilmid->keterangan,
               'date' => $ambilmid->date,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
               'input_by' => $ambilmid->input_by,
          ];

          switch ($prefix) {
               case 'KAS':
                    return self::createOrUpdateTransaction($datain);
               case 'TAB':
                    return self::createOrUpdateTabung($datain);
               case 'DON':
                    return self::createOrUpdateCerit($datain);
               default:
                    return 'UNKNOWN';
          }
     }

     private static function createOrUpdateTransaction($data)
     {
          return Transaction::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
     }

     private static function createOrUpdateTabung($data)
     {
          return Tabung::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
     }

     private static function createOrUpdateCerit($data)
     {
          return Cerit::updateOrCreate(
               ['judul' => $data['judul']],
               $data
          );
     }
}
