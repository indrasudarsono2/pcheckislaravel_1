<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_email extends Model
{
    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
