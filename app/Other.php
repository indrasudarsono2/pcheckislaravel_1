<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    public function aplication_file()
    {
        return $this->hasOne('App\Aplication_file');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
