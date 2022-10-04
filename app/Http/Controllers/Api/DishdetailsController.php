<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishdetailsController extends Controller
{
    public function index($slug) {

        $dishe_details = Dish::where('slug', '=', $slug)->first();

        if( $dishe_details->dish_image) {
            $dishe_details->dish_image = asset('storage/' . $dishe_details->dish_image);
        }

        if($dishe_details) {
            $data = [
                'success' => true,
                'results' => $dishe_details
            ];
        } 
        else {
            $data = [
                'success' => false,
            ];
        }

        return response()->json($data);
    }
}