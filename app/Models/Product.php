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

class Product extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

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
    ////  ------------------End Accessor--------------------------------- ////


    // -------------------other function ---------------------------//
    public function getFirstImageUrl($size='thumb'){
        if($this->getFirstMedia('products')){
            return $this->getFirstMedia('products')->getUrl($size);
        }
        else{
            return asset('images/noimage.jpeg');
        }
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
