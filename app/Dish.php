<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order() {
        return $this->belongsToMany('App\Order');
    }
}
