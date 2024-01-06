<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
            'address2' => fake()->streetAddress(),
            'postal_code' => fake()->numberBetween(4000, 9999),
            'city_id' => fake()->numberBetween(1, 30)
        ];
    }
}
