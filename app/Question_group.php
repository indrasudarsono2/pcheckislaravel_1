<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_group extends Model
{
    public function aplication_rating()
    {
        return $this->belongsTo('App\Aplication_rating');
    }

    public function mc_question()
    {
        return $this->hasMany('App\Mc_question');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
