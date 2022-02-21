<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public function biodata()
    {
        return $this->hasMany('App\Biodata');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
