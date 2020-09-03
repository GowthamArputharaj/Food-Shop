<?php

namespace App;

use App\Foodcart;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function Fooduser()
    {
        return $this->belongsTo('App\Foodcart');
    }
}
