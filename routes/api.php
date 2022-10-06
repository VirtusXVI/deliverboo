<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/ristoranti', 'Api\Usercontroller@index');
Route::get('/filteredrestaurants', 'Api\Usercontroller@filter');
// Route::get('/posts/{slug}', 'Api\Postcontroller@show');

Route::get('/ristorante/{slug}', 'Api\Dishcontroller@index');

Route::get('/dettagli-piatti/{slug}', 'Api\DishdetailsController@index');

Route::get('/categorie', 'Api\Categoriescontroller@index');
// Route::get('/posts/{slug}', 'Api\Postcontroller@show');


// Get from Braintree
Route::get('/orders/generate', 'Api\Orders\OrderController@generateToken');
Route::post('/controll/payment', 'Api\Orders\OrderController@controllPayment');