<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create catetgory, create product relative with category, add media to category
        $categories = Category::factory(3)
        ->has(
            Product::factory()->count(6)
            )
        ->create()->each(function($category){
            $path = 'http://softviet.test/image_for_seeding/category_temp/';
            $imagePath = $path .'c' . rand(1,6) . '.png';
            $category->addMediaFromUrl($imagePath)->toMediaCollection('categories');
        })
        ;
        $this->addMediaProduct();
    }
    // add media to all product
    public function addMediaProduct(){
        Product::all()->each(function($product){
            if($product->getMedia('products')->count()==0){
                $path = 'http://softviet.test/image_for_seeding/products_temp/';
                for($i=1;$i<=3;$i++){
                    $imagePath = $path .'p' . rand(1,30) . '.jpg';
                    $product->addMediaFromUrl($imagePath)->toMediaCollection('products');
                }
            }
        });
    }
}
