<?php

namespace Database\Seeders;

use App\Models\Pcategory;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategoryWithImgAndPost();
    }

     // create catetgory, create post relative with category, add media to category
    public function createCategoryWithImgAndPost(){
        $categories = Pcategory::factory(3)
        ->has(
            Post::factory()->count(6)
            )
        ->create()
        ->each(function($category){
            $path = 'http://softviet.test/image_for_seeding/category_temp/';
            $imagePath = $path .'c' . rand(1,6) . '.png';
            $category->addMediaFromUrl($imagePath)->preservingOriginal()->toMediaCollection('postcategories','postCategoryFiles');
        })
        ;
        $this->addMediaPost();
    }
    // add media to all product
    public function addMediaPost(){
        Post::all()->each(function($post){
            if($post->getMedia('posts')->count()==0){
                $path = 'http://softviet.test/image_for_seeding/products_temp/';
                for($i=1;$i<=3;$i++){
                    $imagePath = $path .'p' . rand(1,30) . '.jpg';
                    // $product->addMediaFromUrl($imagePath)->toMediaCollection('products');
                    $post->addMediaFromUrl($imagePath)->preservingOriginal()->toMediaCollection('posts','postFiles');

                }
            }
        });
    }
}
