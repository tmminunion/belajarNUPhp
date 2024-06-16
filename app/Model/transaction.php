<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class transaction extends Model
{
    protected $connection = 'nuphp';
    public function member()
    {
        return $this->belongsTo(member::class, 'member_id');
    }
}