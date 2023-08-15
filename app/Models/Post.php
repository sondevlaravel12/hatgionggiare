<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
// -----------end spatie media
// ------------spatie laravel-sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// ------------end spatie laravel-sluggable

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;
    protected $guared =[];

     // ------------------- Spatie Media ---------------------------//
     public function registerMediaCollections(): void
     {
         $this
             ->addMediaCollection('posts')
             ->acceptsMimeTypes(['image/jpeg','image/png','image/svg'])
             ->onlyKeepLatest(3)
             ;

     }
     public function registerMediaConversions(Media $media = null): void
     {

        $this
        ->addMediaConversion('thumb')
        ->fit(Manipulations::FIT_FILL, 195, 108, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png');
    $this
        ->addMediaConversion('medium')
        ->fit(Manipulations::FIT_FILL, 390, 217, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png');
    $this
        ->addMediaConversion('large')
        ->fit(Manipulations::FIT_FILL, 780, 433, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png');
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
    // relationship
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    // end of relationship

    //---- other function --------
    // specify populer post depend on comments or likes or views???
    public static function populer($num =2){
        return Post::inRandomOrder()->limit($num)->get();
    }
    //---- end of other function

}
