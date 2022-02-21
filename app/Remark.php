<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    public function user()
    {
        return $this->hasMany('App\UserModel');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
