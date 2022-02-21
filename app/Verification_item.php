<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification_item extends Model
{

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
