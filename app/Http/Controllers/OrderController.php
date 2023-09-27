<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Traits\HttpResponseTrait;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    use HttpResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store()
    {
        $cart = getUserCart(getCurrentUserId());
        if (!$cart->isEmpty()) {
            $cart[0]->is_finished = true;
            return Order::create([
                "user_id" => getCurrentUserId(),
                "total_amount" => $cart[0]->total_cart_amount,
                "order_date" => now(),
            ]);
        } else {
            return "You can't place an order because you don't have active cart yet!";
        }
    }
}
