<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    public function form_rating()
    {
        return $this->hasMany('App\Form_rating');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
