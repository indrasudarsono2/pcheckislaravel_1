<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_book extends Model
{
    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'released' => 'datetime:d-m-Y',
        'expired' => 'datetime:d-m-Y'
    ];
}
