<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function completeness_file()
    {
        return $this->hasMany('App\Completeness_file');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
