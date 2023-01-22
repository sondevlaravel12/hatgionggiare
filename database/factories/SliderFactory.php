<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(fake()->numberBetween(10, 30)),
            // 'slug' => fake()->name(),
            'header' => fake()->name(fake()->numberBetween(10, 30)),
            'big_text' => fake()->name(fake()->numberBetween(10, 30)),
            'short_description' => fake()->name(fake()->numberBetween(20, 50)),
            'call_to_action' => 'Mua ngay',
        ];
    }
}
