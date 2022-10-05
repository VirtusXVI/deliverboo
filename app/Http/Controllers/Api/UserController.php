<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Restaurant_category;

class UserController extends Controller
{
    public function index(Request $request) {
        $filter = $request->all();

        $array_filter = [];

        foreach($filter as $filt) {
            $array_filter = $filt;
        }

        $users = Restaurant_category::with('user')
        ->whereIn('id', $array_filter)
        ->get();


        $data = [
            'results' => $users
        ];

        return response()->json($data);
    }
    
}