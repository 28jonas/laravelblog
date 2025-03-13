<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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
    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),// zal een slug maken gebaseerd op naam van product
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2,10,500),
            'stock_quantity' => $this->faker->numberBetween(0,100),
            'photo_id' => Photo::inRandomOrder()->first()->id ?? null,
        ];
    }
}
