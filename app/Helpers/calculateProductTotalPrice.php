<?php

if (!function_exists('calculateProductTotalPrice')) {
    function calculateProductTotalPrice($product_quantity, $product_price)
    {
        return $product_price * $product_quantity;
    }
}
