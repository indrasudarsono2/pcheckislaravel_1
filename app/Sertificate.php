<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertificate extends Model
{
    public function sertificate_owner()
    {
        return $this->hasMany('App\Sertificate_owner');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
