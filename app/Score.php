<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public function mc_correction()
    {
        return $this->hasMany('App\Mc_correction');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel')->withTrashed();
    }

    public function rating()
    {
        return $this->belongsTo('App\Score');
    }

    public function remark_score()
    {
        return $this->belongsTo('App\Remark_score');
    }

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function essay_correction()
    {
        return $this->hasMany('App\Essay_Correction');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function form_rating()
    {
        return $this->belongsTo('App\Form_rating');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
