<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Tabung extends Model
{
    protected $fillable = [
        'nama', 'noreg', 'member_id', 'jumlah', 'judul', 'date', 'type', 'status', 'input_by', 'payment_type', 'keterangan', 'created_at', 'updated_at'
    ];
    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }
}
