<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'price' => $this->faker->numberBetween(0, 5000),
            'quantity' => $this->faker->numberBetween(0, 5000),
            'creation_date' => $this->faker->dateTime(),
            'expiration_date' => $this->faker->dateTime(),
        ];
    }
}
