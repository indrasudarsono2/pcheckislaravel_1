<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ielp extends Model
{
    protected $table = 'ielp';

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function aplication_file()
    {
        return $this->hasMany('App\Application_file');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'released' => 'datetime:d-m-Y',
        'expired' => 'datetime:d-m-Y'
    ];
}
