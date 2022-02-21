<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other_check extends Model
{
    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function recomendation()
    {
        return $this->belongsTo('App\Recomendation');
    }

    public function completeness_file()
    {
        return $this->hasOne('App\Completeness_file');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
