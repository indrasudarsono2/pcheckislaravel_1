<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay_group extends Model
{
    public function aplication_rating()
    {
        return $this->belongsTo('App\Aplication_rating');
    }

    public function essay()
    {
        return $this->hasMany('App\Essay');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
