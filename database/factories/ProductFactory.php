<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'referencia' => $this->faker->isbn10,
            'precio' => $this->faker->numberBetween(5000, 50000),
            'peso' => $this->faker->numberBetween(1, 10),
            'categoria' => Str::upper($this->faker->word),
            'stock' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
