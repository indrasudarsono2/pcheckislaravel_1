<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Rating extends Model
{
    public function mc_correction()
    {
        return $this->hasMany('App\Mc_correction');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    public function other_check()
    {
        return $this->hasMany('App\Other_check');
    }

    public function rating_confirm()
    {
        return $this->hasMany('App\Rating_confirm');
    }

    public function form_rating()
    {
        return $this->hasMany('App\Form_rating');
    }

    public function aplication_rating()
    {
        return $this->hasMany('App\Aplication_rating');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
