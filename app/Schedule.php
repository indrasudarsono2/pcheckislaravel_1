<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function branch()
    {
        return $this->hasOne('App\Branch');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'schedule_start' => 'datetime:d-m-Y',
        'schedule_finish' => 'datetime:d-m-Y',
    ];
}
