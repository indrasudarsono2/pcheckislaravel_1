<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gain_rating extends Model
{
    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function checker_gain()
    {
        return $this->hasMany('App\Checker_gain');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
