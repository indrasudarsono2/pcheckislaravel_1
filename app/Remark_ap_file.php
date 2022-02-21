<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark_ap_file extends Model
{
    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
