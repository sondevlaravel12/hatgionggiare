<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// -----------end spatie media
// ------------spatie laravel-sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// ------------end spatie laravel-sluggable

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;
    protected $guared =[];

     // ------------------- Spatie Media ---------------------------//
     public function registerMediaCollections(): void
     {
         $this
             ->addMediaCollection('categories')
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
             ->generateSlugsFrom('name')
             ->saveSlugsTo('slug')
             ->doNotGenerateSlugsOnUpdate();
     }
     // ------------------- end Spatie laravel-sluggable ---------------------------//

     // ------------------- Relationship ---------------------------//
     public function Products()
    {
        return $this->hasMany(Product::class);
    }
     // ------------------- End Relationship ---------------------------//

}
