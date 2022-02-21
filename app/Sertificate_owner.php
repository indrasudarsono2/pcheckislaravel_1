<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertificate_owner extends Model
{
    public function sertificate()
    {
        return $this->belongsTo('App\Sertificate');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'released' => 'datetime:d-m-Y',
    ];
}
