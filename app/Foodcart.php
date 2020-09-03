<?php

namespace App;

use App\Food;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Foodcart extends Model
{

    public $timestamps = false;

    public function Food() 
    {
        return $this->hasMany('App\Food');
    }

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
