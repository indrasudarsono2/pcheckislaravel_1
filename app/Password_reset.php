<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    protected $fillable = [
        'created_at', 'email', 'token',
    ];
}
