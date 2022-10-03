<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant_category;

class CategoriesController extends Controller
{
    
    public function index() {

        $category = Restaurant_category::all();

        $data = [
            'success' => true,
            'results' => $category
        ];

        return response()->json($data);
    }

    // public function show($slug) {
    //     $post = Post::where('slug', '=', $slug)->with(['tags', 'category'])->first();

    //     if($post) {
    //         $data = [
    //             'success' => true,
    //             'results' => $post
    //         ];
    //     } else {
    //         $data = [
    //             'success' => false
    //         ];
    //     }

    //     return response()->json($data);
    // }
}
