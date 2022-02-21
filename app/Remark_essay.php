<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark_essay extends Model
{
    public function essay_correction()
    {
        return $this->hasMany('App\Essay_correction');
    }
}
