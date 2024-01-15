<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\HasMediaConversions;
// -----------end spatie media

// ------------spatie laravel-sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// ------------end spatie laravel-sluggable

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug, HasMediaConversions;
    protected $guarded =[];
    // protected $fillable = ['name'];

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

         $this->registerMediaConversionsTrait();
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
     public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent(){
        return $this->belongsTo($this,'parent_id','id');
    }
    public function children()
    {
       return $this->hasMany($this, 'parent_id');
    }
    // public function childrenHasProduct()
    // {
    //    return $this->children()->has('products');
    // }
     // ------------------- End Relationship ---------------------------//

     ////  ------------------ Accessor--------------------------------- ////
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
        );
    }
     ////  ------------------ End Accessor--------------------------------- ////


     public function getFirstImageUrl($size='thumb'){
        if($this->getFirstMedia('categories')){
            return $this->getFirstMedia('categories')->getUrl($size);
        }
        else{
            return asset('noimage.jpeg');
        }
    }

}
