<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $title = $this->faker->realText(50);
        // $description = "<h1>{$title}</h1>";
        $description = "";
        foreach ($paragraphs as $para) {
            $description .= "<p>{$para}</p>";
        }
        $user_id = rand(0,2);
        return [
            'title' => $title,
            'description' => $description,
            'user_id'=>$user_id,

        ];
    }
}
