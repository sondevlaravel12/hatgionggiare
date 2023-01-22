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
// ------------Buyable interface use for cart
use Gloudemans\Shoppingcart\Contracts\Buyable;
// ------------End Buyable interface use for cart


class Product extends Model implements HasMedia, Buyable
{
    use HasFactory;

    use InteractsWithMedia;
    use HasSlug;



    protected $guared =[];

    //Implicit Binding: Customizing The Key Name
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
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
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
    // ------------------- end Spatie laravel-sluggable ---------------------------//

    ////  ------------------ Accessor--------------------------------- ////
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 0, ',', '.') .' đ',
        );
    }
    protected function basePrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 0, ',', '.') .' đ',
        );
    }
    protected function discountPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 0, ',', '.') .' đ',
        );
    }
    protected function originalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 0, ',', '.') .' đ',
        );
    }
    public function getDiscountPercentageAttribute()
{
    $priceBefore = $this->getRawOriginal('price');
    $priceAfter = $this->getRawOriginal('discount_price');
    $discountPercentage =  ceil((($priceBefore - $priceAfter)/$priceBefore) *100);
    //return number_format($discountPercentage, 0, ',', '.');
    return $discountPercentage;
}
    ////  ------------------End Accessor--------------------------------- ////

     // ------------------- Relationship ---------------------------//
     public function Category()
    {
        return $this->belongsTo(Category::class);
    }
     // ------------------- End Relationship ---------------------------//

     // ---------------Buyable  interface.------------------------/////
    public function getBuyableIdentifier($options = null) {
        return $this->id;
    }
    public function getBuyableDescription($options = null) {
        return $this->name;
    }
    public function getBuyablePrice($options = null) {
        return $this->getRawOriginal('discount_price');
    }
    public function getBuyableWeight($options = null) {
        return 1;
    }
    // ---------------End Buyable  interface.------------------------/////

    // -------------------other function ---------------------------//
    public function getFirstImageUrl($size='thumb'){
        if($this->getFirstMedia('products')){
            return $this->getFirstMedia('products')->getUrl($size);
        }
        else{
            return asset('noimage.jpeg');
        }
    }
    public static function getDiscountProducts($numberOfProducts=4){
        $products = Product::all();
        return $products->sortByDesc('discountPercentage')->take($numberOfProducts);
    }
    // public function getImageUrls($size='medium'){
    //     if($this->getMedia('products')){
    //         return $this->getFirstMedia('products')->getUrl($size);
    //     }
    //     else{
    //         return asset('images/noimage.jpeg');
    //     }
    // }
    // -------------------end other function ---------------------------//

}
