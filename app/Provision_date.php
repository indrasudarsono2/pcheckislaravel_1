<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provision_date extends Model
{
    public function aplication_file()
    {
        return $this->hasOne('App\Aplication_file');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
