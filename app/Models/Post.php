<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// -----------end spatie media
// ------------spatie laravel-sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// ------------end spatie laravel-sluggable

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;
    protected $guared =[];

     // ------------------- Spatie Media ---------------------------//
     public function registerMediaCollections(): void
     {
         $this
             ->addMediaCollection('products')
             ->acceptsMimeTypes(['image/jpeg','image/png','image/svg'])
             ->onlyKeepLatest(3)
             ;

     }
     public function registerMediaConversions(Media $media = null): void
     {

        $this
            ->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
        $this
            ->addMediaConversion('medium')
            ->width(300)
            ->height(300);
        $this
            ->addMediaConversion('large')
            ->width(600)
            ->height(600);
     }
     // -------------------End Spatie Media ---------------------------//

     // ------------------- Spatie laravel-sluggable ---------------------------//
     public function getSlugOptions() : SlugOptions
     {
         return SlugOptions::create()
             ->generateSlugsFrom('title')
             ->saveSlugsTo('slug')
             ->doNotGenerateSlugsOnUpdate();
     }
     // ------------------- end Spatie laravel-sluggable ---------------------------//

      // -------------------other function ---------------------------//
    public function getFirstImageUrl($size='thumb'){
        if($this->getFirstMedia('posts')){
            return $this->getFirstMedia('posts')->getUrl($size);
        }
        else{
            return asset('noimage.jpeg');
        }
    }
    public function setDefaultValueForPostExcerpt(){
        $this->excerpt = Str::words(strip_tags($this->description),20,'...');
    }
}
