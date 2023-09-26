<?php

namespace Database\Seeders;

use App\Models\CartDetails;
use Illuminate\Database\Seeder;

class CartDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartDetails::factory(10)->create();
    }
}
