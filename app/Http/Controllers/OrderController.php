<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Traits\HttpResponseTrait;
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
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }


    public function index()
    {
        try {
            return OrderResource::collection(Order::all());
        } catch (Exception $ex) {
            return response()->json([
                $this->failure($ex->getMessage())
            ]);
        }
    }


    public function store(Request $request)
    {

        // try {
        //     $order = Order::create($request->validated());
        //     return OrderResource::make($order);
        // } catch (Exception $ex) {
        //     return response()->json([
        //         $this->failure($ex->getMessage())
        //     ]);
        // }
    }
    public function HelperFunction($product)
    {
        Cart::create([]);
    }

    public function show(Order $order)
    { {
            try {
                return OrderResource::make($order);
            } catch (Exception $ex) {
                $this->failure($ex->getMessage());
            }
        }
    }

    public function update(Request $request, Order $order)
    {
        try {
            $order->update($request->validated());
            return OrderResource::make($order);
        } catch (Exception $ex) {
            $this->failure($ex->getMessage());
        }
    }


    public function destroy(Order $order)
    {
        try {
            $id = $order->id;
            $order->delete();
            return $this->success("Order " . $id .  " has been deleted successfully");
        } catch (Exception $ex) {
            $this->failure($ex->getMessage());
        }
    }
}
