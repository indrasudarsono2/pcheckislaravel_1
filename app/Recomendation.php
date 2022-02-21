<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    public function other_check()
    {
        return $this->hasMany('App\Other_check');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
