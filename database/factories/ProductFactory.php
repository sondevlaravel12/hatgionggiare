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
            'name' => fake()->name(fake()->numberBetween(20, 40)),
            // 'slug' => fake()->name(),
            'price' => fake()->randomNumber(5),
            'base_price' => fake()->randomNumber(5),
            'discount_price' => fake()->randomNumber(5),
            'original_price' => fake()->randomNumber(5),
            'short_description' => fake()->realText(),
            'description' => fake()->realText(),
            'specification' => fake()->realText(),
            // 'status' => now(),
        ];
    }
}
