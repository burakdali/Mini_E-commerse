<?php

namespace App\Traits;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait Purchasable
{

    protected function addProductToCart($product_id, $quantity, $user_id)
    {
        $cart = getUserCart($user_id);
        $product = Product::find($product_id);
        if (!$cart->isEmpty()) {
            CartDetails::create([
                "cart_id" => $cart[0]->id,
                "product_id" => $product_id,
                "quantity" => $quantity,
            ]);
            $cart[0]->total_cart_amount += calculateProductTotalPrice($product->price, $quantity);
            $cart[0]->save();
            return $cart[0];
        } else {
            $new_cart = Cart::create([
                "user_id" => $user_id,
                "total_cart_amount" => calculateProductTotalPrice($product->price, $quantity),
                "is_finished" => 0,
            ]);
            return CartDetails::create([
                "cart_id" => $new_cart->id,
                "product_id" => $product_id,
                "quantity" => $quantity,
            ]);
        }
    }

    protected function removeProductFromCart($product_id, $user_id)
    {
        $cart = getUserCart($user_id);
        $product = Product::find($product_id);
        if (!$cart->isEmpty()) {
            $cartDetails = CartDetails::where("cart_id", $cart[0]->id)
                ->where("product_id", $product_id)
                ->get();
            if (!$cartDetails->isEmpty()) {
                $cartDetails[0]->delete();
                $cart[0]->total_cart_amount -= calculateProductTotalPrice($product->price, $cartDetails[0]->quantity);
                return $cart[0];
            }
        } else {
            return "This Product:" . $product->name . " isn't in your Cart Yet";
        }
    }
}
