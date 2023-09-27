<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


#Get All Products
Route::get("products", [ProductController::class, "index"]);
#Get signed User Cart
Route::get("cart", [CartController::class, "index"]);
#Add New Product To Cart
Route::post("cart/add", [CartController::class, "store"]);
#remove Product From Cart
Route::post("cart/remove", [CartController::class, "remove"]);
#Place New Order
Route::post("orders/place", [OrderController::class, "store"]);

#Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
