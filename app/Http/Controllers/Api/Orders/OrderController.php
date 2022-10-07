<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\OrderRequest;
use App\Dish;

class OrderController extends Controller
{
    public function generateToken(Request $request, Gateway $gateway) {
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function controllPayment(OrderRequest $request, Gateway $gateway) {

        // $product = Dish::find($request);
        $product = $request->all();

        // dd($product['product']);

        $data = [
            'success' => true,
            'product' => $product
        ];


        // return response()->json($data);

        $result = $gateway->transaction()->sale([
            'amount' => $product->price,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response()->json($data,200);
        }else{
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!!"
            ];
            return response()->json($data,401);
        }
        
    }
}
