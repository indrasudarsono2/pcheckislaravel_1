<?php

namespace App;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $foreignKey = 'ojti_id';

    public function aplication_file()
    {
        return $this->hasOne('App\Aplication_file');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function ojti()
    {
        return $this->belongsTo('App\UserModel', 'ojti_id');
    }


    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'start' => 'datetime:d-m-Y',
        'finish' => 'datetime:d-m-Y'
    ];
}
