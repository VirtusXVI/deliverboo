<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Dish;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $data = [
            'user' => $user
        ];
        return view('admin.home', $data);
    }

    public function orders() {
        $user = Auth::user();
        // $orders = Order::orderBy('created_at', 'desc')->get();
        $dish = Dish::where('user_id', '=', $user->id)->get();

        $data = [
            'orders' => $orders
        ];

        return view('admin.orders.index', $data);
    }

    public function stats() {
        $orders = Order::orderBy('created_at', 'desc')->get();

        $data = [
            'orders' => $orders
        ];

        return view('admin.orders.stats', $data);
    }
}
