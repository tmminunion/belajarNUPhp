<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{


    protected $table = 'pesans';

    protected $fillable = [
        'nomor',
        'jenis',
        'lampiran',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}