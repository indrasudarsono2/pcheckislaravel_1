<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Practical_exam extends Model
{
    public function user()
    {
        return $this->belongsTo('App\UserModel', 'checker_id')->withTrashed();
    }

    public function form_rating()
    {
        return $this->belongsTo('App\Form_rating');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function checker_gain()
    {
        return $this->belongsTo('App\Checker_gain');
    }

    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
