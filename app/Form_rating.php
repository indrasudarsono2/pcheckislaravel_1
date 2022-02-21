<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_rating extends Model
{
    public function aplication_file()
    {
        return $this->belongsTo('App\Aplication_file');
    }

    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function practical_exam()
    {
        return $this->hasMany('App\Practical_exam');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
