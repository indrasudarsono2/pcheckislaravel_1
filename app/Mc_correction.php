<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mc_correction extends Model
{
    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function mc_question()
    {
        return $this->belongsTo('App\Mc_question')->withTrashed();
    }

    public function score()
    {
        return $this->belongsTo('App\Score');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
