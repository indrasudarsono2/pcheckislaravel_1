<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function user()
    {
        return $this->hasMany('App\UserModel');;
    }

    public function aplication_rating()
    {
        return $this->hasMany('App\Aplication_rating');
    }

    public function group()
    {
        return $this->hasMany('App\Group');
    }

    public function gain_rating()
    {
        return $this->hasMany('App\Gain_rating');
    }

    public function session()
    {
        return $this->hasMany('App\Session');
    }

    public function essay()
    {
        return $this->hasMany('App\Essay');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schecdule');
    }

    public function provision()
    {
        return $this->hasOne('App\Provision');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
