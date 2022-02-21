<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    public function other_check()
    {
        return $this->hasMany('App\Other_check');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
