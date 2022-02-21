<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification_data extends Model
{
    public function aplication_file()
    {
        return $this->belongsTo('App\Aplication_file');
    }

    public function verification_item()
    {
        return $this->belongsTo('App\Verification_item');
    }

    public function checker()
    {
        return $this->belongsTo('App\UserModel', 'checker_id');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'provision_date' => 'datetime:d-m-Y h:i:s',
    ];
}
