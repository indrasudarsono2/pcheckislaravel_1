<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating_confirm extends Model
{
    public function aplication_file()
    {
        return $this->hasOne('App\Aplication_file');
    }

    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $cast = [
        'date' => 'datetime:d-m-Y'
    ];
}
