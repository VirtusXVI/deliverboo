<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant_category extends Model
{
    protected $table = 'restaurant_categories';

    public function user() {
        return $this->belongsToMany('App\User');
    }
}
