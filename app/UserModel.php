<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class UserModel extends Model
{

    protected $table = 'users';

    use SoftDeletes;

    public function biodata()
    {
        return $this->hasOne('App\Biodata');
    }

    public function completeness_file()
    {
        return $this->hasMany('App\Completeness_file');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function remark()
    {
        return $this->belongsTo('App\Remark');
    }

    public function score()
    {
        return $this->hasMany('App\Score');
    }

    public function other_check()
    {
        return $this->hasMany('App\Other_check');
    }

    public function aplication_file()
    {
        return $this->hasMany('App\Aplication_file');
    }

    public function education_owner()
    {
        return $this->hasMany('App\Education_owner');
    }

    public function sertificate_owner()
    {
        return $this->hasMany('App\Sertificate_owner');
    }

    public function ielp()
    {
        return $this->hasMany('App\Ielp');
    }

    public function medex()
    {
        return $this->hasMany('App\Medex');
    }

    public function control()
    {
        return $this->hasMany('App\Control');
    }

    public function group()
    {
        return $this->hasMany('App\Group');
    }

    public function group_member()
    {
        return $this->hasMany('App\Group_member');
    }

    public function gain_rating()
    {
        return $this->hasMany('App\Gain_rating');
    }

    public function checker_gain()
    {
        return $this->hasMany('App\Checker_gain');
    }

    public function practical_exam()
    {
        return $this->hasMany('App\Practical_exam');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function provision_date()
    {
        return $this->hasMany('App\Provision_date');
    }

    public function license()
    {
        return $this->hasMany('App\License');
    }

    public function log_book()
    {
        return $this->hasMany('App\Log_book');
    }


    protected $fillable = [
        'id', 'name', 'password', 'remark_id', 'position_id', 'branch_id'
    ];
}
