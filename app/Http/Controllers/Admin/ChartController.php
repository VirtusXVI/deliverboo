<?php

namespace App\Http\Controllers\Admin;

use App\Chart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get users grouped by age
        // $orders = DB::table('orders')->select('*');
        // $orders = Order::all();

        $orders = DB::table('orders')
                  ->select('created_at', DB::raw('count(*) as total'))
                  ->groupBy('created_at')
                  ->pluck('total', 'created_at')->all();
        for ($i=0; $i<=count($orders); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        
        // Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($orders));
        $chart->dataset = (array_values($orders));
        $chart->colours = $colours;
        return view('admin.orders.charts', compact('chart'));
    }
}
