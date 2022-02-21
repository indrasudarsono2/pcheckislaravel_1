<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodata';

    public function user()
    {
        return $this->belongsTo('App\UserModel');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $dates = [
        'date_of_birth'
    ];

    protected $casts = [
        'date_of_birth' => 'datetime:d-m-Y',

    ];
}
