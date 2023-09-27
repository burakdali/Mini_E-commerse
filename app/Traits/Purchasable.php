<?php

namespace App\Traits;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait Purchasable
{

    protected function addProductToCart($product_id, $quantity)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where("user_id", $user_id)
            ->where("is_finished", 0)
            ->get();
        CartDetails::create([
            "cart_id" => $cart[0]->id,
            "product_id" => $product_id,
            "quantity" => $quantity,
        ]);
        $product = Product::find($product_id);
        if (!$cart->isEmpty()) {
            $cart[0]->total_cart_amount += calculateProductTotalPrice($product->price, $quantity);
            $cart[0]->save();
            return $cart[0];
        } else {
            Cart::create([
                "user_id" => Auth::user()->id,
                "total_cart_amount" => calculateProductTotalPrice($product->price, $quantity),
                "is_finished" => 0,
            ]);
        }
    }
}
