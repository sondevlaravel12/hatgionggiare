<?php

namespace App\Models;

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

class Pcategory extends Model implements HasMedia
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
             ->addMediaCollection('postcategories')
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
     public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function parent(){
        return $this->belongsTo($this,'parent_id','id');
    }
    public function children()
    {
       return $this->hasMany($this, 'parent_id');
    }
    public function metatag()
    {
        return $this->morphOne(Metatag::class, 'model');
    }
     // ------------------- End Relationship ---------------------------//

     public function getFirstImageUrl($size='thumb'){
        if($this->getFirstMedia('postscategories')){
            return $this->getFirstMedia('postcategories')->getUrl($size);
        }
        else{
            return asset('noimage.jpeg');
        }
    }
}
