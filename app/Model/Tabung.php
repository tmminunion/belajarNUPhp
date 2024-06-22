<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Tabung extends Model
{
    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }
}
