<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplication_file extends Model
{
    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel')->withTrashed()->orderBy('name', 'asc');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function provision()
    {
        return $this->belongsTo('App\Provision');
    }

    public function rating_confirm()
    {
        return $this->belongsTo('App\Rating_confirm');
    }

    public function medex()
    {
        return $this->belongsTo('App\Medex');
    }

    public function ielp()
    {
        return $this->belongsTo('App\Ielp');
    }

    public function control()
    {
        return $this->belongsTo('App\Control');
    }

    public function provison_date()
    {
        return $this->belongsTo('App\Provision_date');
    }

    public function remark_ap_file()
    {
        return $this->belongsTo('App\Remark_ap_file');
    }

    public function form_rating()
    {
        return $this->hasMany('App\Form_rating');
    }

    public function license()
    {
        return $this->belongsTo('App\License');
    }

    public function logbook()
    {
        return $this->belongsTo('App\Log_book');
    }

    public function verification_data()
    {
        return $this->hasMany('App\Verification_data');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'provision_date' => 'datetime:d-m-Y h:i:s',
    ];
}
