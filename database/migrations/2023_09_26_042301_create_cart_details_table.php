<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cart_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedInteger("quantity");
            $table->timestamps();
            $table->foreign("cart_id")->on("carts")->references("id")->cascadeOnDelete();
            $table->foreign("product_id")->on("products")->references("id")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_details');
    }
};
