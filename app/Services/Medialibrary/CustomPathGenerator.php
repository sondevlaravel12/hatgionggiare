<?php
namespace App\Services\MediaLibrary;

use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomPathGenerator implements BasePathGenerator
{
    public function getPath(Media $media) : string
    {
        if ($media->model_type == 'App\Models\Product') {
            return 'products/' .$media->id .'/';
        }
        if ($media->model_type == 'App\Models\Post') {
            return 'posts/' .$media->id .'/';
        }
        if ($media->model_type == 'App\Models\Slider') {
            return 'sliders/' .$media->id .'/';
        }
        if ($media->model_type == 'App\Models\Category') {
            return 'categories/' .$media->id .'/';
        }

    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
