<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use App\Traits\HttpResponseTrait;
use App\Traits\Purchasable;
use Exception;
use GrahamCampbell\ResultType\Success;
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
        try {
            $user_id = Auth::user()->id;
            $cart = Cart::where("user_id", $user_id)
                ->where("is_finished", 0)
                ->get();
            if (!$cart->isEmpty()) {
                return $this->success("Your Active Cart is", $cart);
            } else return $this->success("Your Cart is Empty");
        } catch (Exception $ex) {
            return $this->failure($ex->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            $user_id = getCurrentUserId();
            $cart = $this->addProductToCart($request->product_id, $request->quantity, $user_id);
            return $cart;
        } catch (Exception $ex) {
            return $this->failure($ex->getMessage());
        }
    }
    public function remove(Request $request)
    {
        try {
            $user_id = getCurrentUserId();
            return $this->removeProductFromCart($request->product_id, $user_id);
        } catch (Exception $ex) {
            return $this->failure($ex->getMessage());
        }
    }
}
