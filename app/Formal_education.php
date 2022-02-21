<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formal_education extends Model
{
    public function education_owner()
    {
        return $this->hasMany('App\Education_owner');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
