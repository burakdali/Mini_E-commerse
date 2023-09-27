<?php

use App\Models\Cart;

if (!function_exists("getUserCart")) {

    function getUserCart($user_id)
    {
        $cart = Cart::where("user_id", $user_id)
            ->where("is_finished", 0)
            ->get();
        return $cart;
    }
}
