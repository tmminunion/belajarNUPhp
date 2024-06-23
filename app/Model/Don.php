<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Don extends Model
{
    protected $fillable = [
        'eventid', 'slug', 'nama_acara', 'deskripsi', 'created_at', 'updated_at', 'member_id'
    ];
}
