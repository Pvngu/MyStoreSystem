<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->numberBetween(1,40),
            'date' => fake()->date(),
            'status' => fake()->randomElement(['paid', 'canceled', 'refunded', 'pending']),
            'total_amount' => fake()->randomFloat(2, 5, 30)
        ];
    }
}
