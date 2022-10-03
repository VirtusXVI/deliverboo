<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant_category;

class CategoryController extends Controller
{
    public function index() {

        $categories = Restaurant_category::all();

        $data = [
            'success' => true,
            'results' => $categories
        ];

        return response()->json($data);
    }
}
