<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'stock' => fake()->numberBetween(0, 20),
            'cost_price' => fake()->randomFloat(2, 0, 2),
            'unit_price' => fake()->randomFloat(2, 2, 3),
            'category_id' => fake()->numberBetween(1,6)
        ];
    }
}
