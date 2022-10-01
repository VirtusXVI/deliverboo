<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() {

        $user = User::all();

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