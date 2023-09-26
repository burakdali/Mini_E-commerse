<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        try {
            return ProductResource::collection(Product::all());
        } catch (Exception $ex) {
            return response()->json([
                "Error" => $ex->getMessage()
            ]);
        }
    }


    public function store(Request $request)
    {
        try {
            $product = Product::create($request->validated());
            return ProductResource::make($product);
        } catch (Exception $ex) {
            return response()->json([
                "Error" => $ex->getMessage(),
            ]);
        }
    }

    public function show(Product $product)
    {
        try {
            return ProductResource::make($product);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function update(Request $request, Product $product)
    {
        try {
            $product->update($request->validated());
            return ProductResource::make($product);
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }


    public function destroy(Product $product)
    {
        try {
            $id = $product->id;
            $product->delete();
            return response()->json([
                "status" => "Success",
                "response" => "Product $id has been deleted succesfully"
            ]);
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
}
