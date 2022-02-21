<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay_correction extends Model
{
    public function score()
    {
        return $this->belongsTo('App\Score');
    }

    public function essay()
    {
        return $this->belongsTo('App\Essay')->withTrashed();
    }

    public function remark_essay()
    {
        return $this->belongsTo('App\Remark_essay');
    }

    public function checker()
    {
        return $this->belongsTo('App\UserModel', 'checker_id');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
