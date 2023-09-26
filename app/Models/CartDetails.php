<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        "cart_id",
        "product_id",
        "quantity",
    ];
    function cart()
    {
        return $this->belongsTo(Cart::class, "cart_id");
    }
    function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
