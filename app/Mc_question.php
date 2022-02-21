<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mc_question extends Model
{
    use SoftDeletes;
    
    public function aplication_rating()
    {
        return $this->belongsTo('App\Aplication_rating');
    }

    public function question_group()
    {
        return $this->belongsTo('App\Question_group');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
