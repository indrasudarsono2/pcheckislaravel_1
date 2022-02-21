<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'validity' => 'datetime:d-m-Y h:i:s',
    ];
}
