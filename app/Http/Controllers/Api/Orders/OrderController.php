<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generateToken(Request $request) {
        return 'generate';
    }

    public function controllPayment(Request $request) {
        return 'controll payment';
    }
}
