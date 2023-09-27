<?php

namespace App\Traits;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait Purchasable
{
    #the cart logic in my app is containing of two tables so we need to add data to two tables

    protected function addToCart($request)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where("user_id", $user_id)
            ->where("is_finished", 0)
            ->get();
        CartDetails::create([
            "cart_id" => $cart[0]->id,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
        ]);
        $product = Product::find($request->product_id);
        if (!$cart->isEmpty()) {
            $cart[0]->total_cart_amount += ($product->price * $request->quantity);
            $cart[0]->save();
            return $cart[0];
        } else {
            Cart::create([
                "user_id" => Auth::user()->id,
                "total_cart_amount" => $product->price * $request->quantity,
                "is_finished" => 0,
            ]);
        }
    }
    protected function addToSingleTable($request, $tableName, ...$attributes)
    {
    }

    protected function addToDoubleTable($request, $mainTable, $detailsTable, ...$mainTableAttributes, ...$detailsTableAttributes)
    {
    }
}
