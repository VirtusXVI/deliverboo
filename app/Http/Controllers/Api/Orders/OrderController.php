<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\OrderRequest;
use App\Dish;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use App\Mail\SendAdminMail;
use App\User;
use App\DishOrder;

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
        $dish_array = $request->dish_info;

        $data = [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'total_price' => $total_price,
            'dish_array' => $dish_array,
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

        foreach($dish_array as $dish) {
            $dish_order = new DishOrder();
            $dish_order->dish_id = $dish['id'];
            $dish_order->order_id = $new_order->id;
            $dish_order->dish_quantity = $dish['quantity'];
            $dish_order->timestamps = false;
            $dish_order->save();
        }
        

        $user_id = $dish_array[0]['user_id'];

        $user = User::where('id', '=', $user_id)->get();

        Mail::to($customer_email)->send(new SendNewMail());
        Mail::to($user[0]['email'])->send(new SendAdminMail());

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
