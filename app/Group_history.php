<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_history extends Model
{
    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    protected $table = "groups";
}
