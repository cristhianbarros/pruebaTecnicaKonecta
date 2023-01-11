<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_id = Product::all()->random()->id;

        return [
            'cantidad' => $this->faker->numberBetween(0, 100),
            'product_id' => $product_id
        ];
    }
}
