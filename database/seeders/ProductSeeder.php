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
        $products = Product::factory(10)->create();
        $path = '/Users/sonnguyen/Desktop/devweb/softviet/public/frontend/assets/images/products_temp/';
        foreach($products as $index=> $product){
            if($index>0)$index= $index*3;
            for($i=1;$i<=3;$i++){
                $imagePath = $path .'p' . $index+$i . '.jpg';
                $product->addMedia($imagePath)->toMediaCollection('products');
            }

        }
    }
}
