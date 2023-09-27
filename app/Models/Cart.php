<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "total_cart_amount",
        "is_finished"
    ];
    function cartDetails()
    {
        return $this->hasMany(CartDetails::class, "cart_id");
    }
    function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
