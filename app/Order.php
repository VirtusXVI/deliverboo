<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 'customer_address', 'customer_email', 'total_price',
    ];

    public function dish() {
        return $this->belongsToMany('App\Dish');
    }
}
