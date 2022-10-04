<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\User;

class DishController extends Controller
{
   public function index($id) {
        $dishes = Dish::where('user_id', '=', $id)->get();

        foreach($dishes as $dish) {
            if($dish->dish_image) {
                if($dish->dish_image) {
                    $dish->dish_image = asset('storage/' . $dish->dish_image);
                }
            }
        }

        $data = [
            'success' => true,
            'results' => $dishes
        ];

        return response()->json($data);
    }
}