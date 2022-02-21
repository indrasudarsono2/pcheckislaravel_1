<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\UserModel')->withTrashed();
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function group_member()
    {
        return $this->hasMany('App\Group_member');
    }

    public function practical_exam()
    {
        return $this->hasMany('App\Practical_exam');
    }


    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
