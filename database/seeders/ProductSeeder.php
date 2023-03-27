<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(5)->create()->each(function($product){
            $path = 'http://softviet.test/image_for_seeding/products_temp/';
            for($i=1;$i<=3;$i++){
                $imagePath = $path .'p' . rand(1,30) . '.jpg';
                // $product->addMediaFromUrl($imagePath)->preservingOriginal()->toMediaCollection('products','productFiles');
                $product->addMediaFromUrl($imagePath)->preservingOriginal()->toMediaCollection('products');
            }
        });
    }
}
