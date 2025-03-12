<?php

namespace Database\Factories;

use App\Models\User;
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
            'total_price' => $this->faker->randomFloat(2,10,500),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
