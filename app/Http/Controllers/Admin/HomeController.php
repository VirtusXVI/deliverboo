<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Dish;
use App\DishOrder;
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

        $dishes = Dish::where('user_id', '=', $user->id)->get();

        $dish_array = [];
        $order_array = [];
        $dishList = [];

        foreach($dishes as $dish) {
            array_push($dish_array, $dish->id);
        }

        $dish_order = DishOrder::whereIn('dish_id', $dish_array)->get();

        foreach($dish_order as $dish_order) {
            array_push($order_array, $dish_order->order_id);
            array_push($dishList, $dish_order);
        }

        $orders = Order::whereIn('id', $order_array)->orderBy('created_at', 'desc')->with('dish')->paginate(10);
        
        $data = [
            'orders' => $orders,
            'dishQuantity' => $dishList,
            'dishes' => $dishes
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
