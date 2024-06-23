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

    public function Donasi()
    {
        return $this->hasMany(Cerit::class, 'member_id');
    }
    public function getdonasi($don_id)
    {
        return $this->Donasi()->where('don_id', $don_id)->sum('jumlah');
    }
}
