<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
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
            'code' => fake()->text(20),
            'discount' => fake()->randomNumber(2),
            'expiry' => fake()->dateTime()
        ];
    }
}
