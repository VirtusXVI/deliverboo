<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\OrderRequest;
use App\Dish;
use App\Order;

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
        
        $result = $gateway->transaction()->sale([
            'amount' => $request->product,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $total_price = $request->product;
        $customer_name = $request->customer_name;
        $customer_email = $request->customer_mail;
        $customer_address = $request->customer_address;

        $data = [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'total_price' => $total_price
        ];

        $validator = Validator::make($data, [
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|max:255',
            'customer_address' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_order = new Order;
        $new_order->fill($data);
        $new_order->save();

        return response()->json($result);

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
