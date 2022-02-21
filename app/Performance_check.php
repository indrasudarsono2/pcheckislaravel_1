<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance_check extends Model
{
    public function aplication_rating()
    {
        return $this->belongsTo('App\Aplication_rating');
    }

    public function question_varian()
    {
        return $this->belongsTo('App\Question_varian');
    }
    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
