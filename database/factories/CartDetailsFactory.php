<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartDetails>
 */
class CartDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "cart_id" => $this->faker->numberBetween(1, 10),
            "product_id" => $this->faker->numberBetween(1, 10),
            "quantity" => $this->faker->randomNumber(4),
        ];
    }
}
