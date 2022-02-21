<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_member extends Model
{
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel')->withTrashed();
    }
    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
