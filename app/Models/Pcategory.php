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
    // Phương thức trả về tất cả các bài viết thuộc danh mục này hoặc các danh mục con của nó
    public function allPosts()
    {
        // Lấy tất cả các danh mục con
        $descendants = $this->descendants()->pluck('id');

        // Thêm danh mục hiện tại vào danh sách danh mục
        $categories = $descendants->push($this->id);

        // Lấy tất cả các bài viết thuộc các danh mục
        return Post::whereIn('pcategory_id', $categories)->get();
    }

    public function parent(){
        return $this->belongsTo($this,'parent_id','id');
    }
    public function children()
    {
       return $this->hasMany($this, 'parent_id');
    }
    // Define the method to get ancestors
    public function ancestors()
    {
        $ancestors = [];
        $parent = $this->parent;

        // Traverse up the hierarchy until no parent is found
        while ($parent) {
            $ancestors[] = $parent;
            $parent = $parent->parent;
        }

        return collect($ancestors); // Return a collection for easy manipulation
    }
    // Get all descendants (children)
    public function descendants()
    {
        $descendants = collect();
        $children = $this->children;
        foreach ($children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->descendants());
        }
        return $descendants;
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
