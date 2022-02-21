<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Essay extends Model
{
    use SoftDeletes;

    public function essay_correction()
    {
        return $this->hasMany('App\Essay_correction');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function aplication_rating()
    {
        return $this->belongsTo('App\Aplication_rating');
    }

    public function essay_group()
    {
        return $this->belongsTo('App\Essay_group');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
