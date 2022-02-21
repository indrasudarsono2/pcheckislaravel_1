<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_varian extends Model
{
    public function performance_check()
    {
        return $this->hasMany('App\Performance_check');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
