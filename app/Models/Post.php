<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug, HasTags;
    protected $guarded =['id'];

     // ------------------- Spatie Media ---------------------------//
     public function registerMediaCollections(): void
     {
         $this
             ->addMediaCollection('posts')
             ->acceptsMimeTypes(['image/jpeg','image/png','image/svg'])
             ->onlyKeepLatest(1)
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
        ->format('png')
        ->optimize();  ;
    $this
        ->addMediaConversion('medium')
        ->fit(Manipulations::FIT_FILL, 390, 217, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png')
        ->optimize();  ;
    $this
        ->addMediaConversion('large')
        ->fit(Manipulations::FIT_FILL, 780, 433, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png')
        ->optimize();  ;
    $this
        ->addMediaConversion('og-image')
        ->fit(Manipulations::FIT_FILL, 1200, 630, function ($constraint) {
            $constraint->upsize();
        })
        ->background('fff')
        ->format('png')
        ->optimize();  ;
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
        $this->excerpt = Str::words(strip_tags($this->description),100,'...');
    }
    ////  ------------------ Accessor--------------------------------- ////
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
            set: fn ($value) => mb_strtolower($value, 'UTF-8'),
        );
    }
    ////  ------------------end Accessor--------------------------------- ////

    // relationship
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Pcategory()
    {
        return $this->belongsTo(Pcategory::class);
    }
    public function sample(): MorphOne
    {
        return $this->morphOne(Sample::class, 'sampleable');
    }
    public function metatag()
    {
        return $this->morphOne(Metatag::class, 'model');
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }
    // end of relationship

    //---- other function --------
    // specify populer post depend on comments or likes or views???
    public static function populer($num =2){
        return Post::inRandomOrder()->limit($num)->get();
    }
    public function getCategorySlugs()
    {
        // Kiểm tra nếu bài viết có danh mục
        if ($this->pcategory) {
            // Lấy tất cả các danh mục cha của bài viết
        $ancestors = $this->pcategory->ancestors()->pluck('slug')->toArray();

        // Thêm slug của danh mục hiện tại
        $ancestors[] = $this->pcategory->slug;
        // Loại bỏ các danh mục không tồn tại
        $validAncestors = array_filter($ancestors, function($slug) {
            return Pcategory::where('slug', $slug)->exists();
        });

        // Nối các slug với nhau bằng dấu '/'
        return implode('/', $ancestors);
        }

        // Trả về chuỗi rỗng nếu bài viết không có danh mục
        return '';
    }

    //---- end of other function

}
