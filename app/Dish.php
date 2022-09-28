<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'ingredients', 'price', 'is_visible','dish_image', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order() {
        return $this->belongsToMany('App\Order');
    }
}
