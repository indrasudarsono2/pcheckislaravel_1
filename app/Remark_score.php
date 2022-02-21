<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark_score extends Model
{
    public function score()
    {
        return $this->hasMany('App\Score');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
