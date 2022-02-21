<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acp_question extends Model
{
    protected $table = 'mc_questions';

    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function mc_correction()
    {
        return $this->hasMany('App\Mc_correction');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
