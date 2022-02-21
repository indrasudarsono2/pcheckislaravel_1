<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplication_rating extends Model
{
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function question_group()
    {
        return $this->hasMany('App\Question_group');
    }

    public function essay_group()
    {
        return $this->hasMany('App\Essay_group');
    }

    public function mc_question()
    {
        return $this->hasMany('App\Mc_question');
    }

    public function performance_check()
    {
        return $this->hasMany('App\Performance_check');
    }

    public function essay()
    {
        return $this->hasMany('App\Essay');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
