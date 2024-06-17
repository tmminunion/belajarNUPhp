<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class member extends Model
{


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'member_id');
    }
}
