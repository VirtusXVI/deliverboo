<?php

namespace App\Http\Controllers\Admin;

use App\Chart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use DB;
use Faker\Generator as Faker;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Faker $faker)
    {
        // Get users grouped by age
        // $orders = DB::table('orders')->select('*');
        // $orders = Order::all();

        $orders = [];
        $random_data = [];
        $filled_array = [];
        for($i = 0; $i < 10; $i++){
            array_push($orders, $faker->date('Y-m-d'));
        }
        for($i = 0; $i < 10; $i++){
            array_push($random_data, rand(1,40));
        }
        $orders = array_combine($orders, $random_data);

        // for ($i=0; $i<=count($orders); $i++) {
        //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        // }
        $colours = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        
        // Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($orders));
        $chart->dataset = (array_values($orders));
        $chart->colours = $colours;
        return view('admin.orders.charts', compact('chart'));
    }
}
