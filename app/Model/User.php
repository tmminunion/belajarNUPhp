<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class user extends Model
{

    protected $fillable = ['email', 'username', 'password_hash'];
}
