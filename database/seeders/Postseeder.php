<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(5)->create()->each(function($post){
            $path = 'http://softviet.test/image_for_seeding/posts/';
            $imagePath = $path .'p' . rand(1,5) . '.jpg';
            $post->addMediaFromUrl($imagePath)->toMediaCollection('posts');
            $post->setDefaultValueForPostExcerpt();
            $post->save();
        });

    }
}
