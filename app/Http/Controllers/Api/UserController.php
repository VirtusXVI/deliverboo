<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Restaurant_category;

class UserController extends Controller
{
    public function index(Request $request) {

        $user = User::find(1)->restaurant_category()->get();

        $data = [
            'success' => true,
            'results' => $user
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