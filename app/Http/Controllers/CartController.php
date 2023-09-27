<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use App\Traits\HttpResponseTrait;
use App\Traits\Purchasable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use HttpResponseTrait, Purchasable;

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where("user_id", $user_id)
            ->where("is_finished", 0)
            ->get();
        return $this->success("Your Active Cart is", $cart);
    }


    public function store(Request $request)
    {
        $this->addProductToCart($request->product_id, $request->quantity);
    }

    public function show(Cart $cart)
    {
    }

    public function update(Request $request, Cart $cart)
    {
    }


    public function destroy(Cart $cart)
    {
    }
}
