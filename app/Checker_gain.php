<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checker_gain extends Model
{
    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function gain_rating()
    {
        return $this->belongsTo('App\Gain_rating');
    }

    public function practical_exam()
    {
        return $this->hasMany('App\Practical_exam');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
