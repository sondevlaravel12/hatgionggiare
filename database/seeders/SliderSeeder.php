<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::factory(2)->create()->each(function($product){
            $path = 'http://softviet.test/image_for_seeding/sliders/';

            $imagePath = $path .'s' . rand(1,2) . '.jpg';
            $product->addMediaFromUrl($imagePath)->toMediaCollection('sliders');

        });
    }
}
