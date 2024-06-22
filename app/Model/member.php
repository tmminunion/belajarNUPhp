<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class member extends Model
{


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'member_id');
    }
    public function tabungan()
    {
        return $this->hasMany(Tabung::class, 'member_id');
    }

    public function getSaldoAttribute()
    {
        return $this->tabungan()->sum('jumlah');
    }
}
