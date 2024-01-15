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
use Spatie\Image\Manipulations;
use App\Traits\HasMediaConversions;
// for spatie tag
use Spatie\Tags\HasTags;



class Product extends Model implements HasMedia, Buyable
{
    use HasFactory, InteractsWithMedia, HasSlug, HasMediaConversions, HasTags;


    protected $guarded =[];

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
            ->onlyKeepLatest(5)
            ;

    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->registerMediaConversionsTrait();
    }
    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('thumb')
    //         ->fit(Manipulations::FIT_FILL, 100, 100, function ($constraint) {
    //             $constraint->upsize();
    //         })
    //         ->background('fff')
    //         // ->border('000', 10)
    //         ->format('png');
    //     $this
    //         ->addMediaConversion('medium')
    //         ->fit(Manipulations::FIT_FILL, 300, 300, function ($constraint) {
    //             $constraint->upsize();
    //         })
    //         ->background('fff')
    //         // ->border('000', 10)
    //         ->format('png');
    //     $this
    //         ->addMediaConversion('large')
    //         ->fit(Manipulations::FIT_FILL, 600, 600, function ($constraint) {
    //             $constraint->upsize();
    //         })
    //         ->background('fff')
    //         // ->border('000', 10)
    //         ->format('png');
    // }

    public function getSquarePosition($constraint)
    {
        $constraint->aspectRatio();
        $constraint->upsize();
        $constraint->background('ffffff');
        $constraint->size($this->getWidth(), $this->getWidth(), 'center');
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
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
        );
    }
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
    // $priceBefore = $this->getRawOriginal('price');
    $priceBefore = $this->getRawOriginal('base_price');
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
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
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
    // specify populer products depend on what ???
    public static function populer($num =2){
        return Product::inRandomOrder()->limit($num)->get();
    }
    // specify hotdeal products depend on what ???
    public static function hotDeals($num =3){
        // return Product::inRandomOrder()->limit($num)->get();
        return Product::getDiscountProducts(3);
    }
    // -------------------end other function ---------------------------//

}
