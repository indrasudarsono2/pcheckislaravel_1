<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education_owner extends Model
{
    public function formal_education()
    {
        return $this->belongsTo('App\Formal_education');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
