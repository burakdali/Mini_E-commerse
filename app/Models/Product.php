<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'creation_date',
        'expiration_date'
    ];

    function cartDetails()
    {
        return $this->hasMany(CartDetails::class, "product_id");
    }
}
