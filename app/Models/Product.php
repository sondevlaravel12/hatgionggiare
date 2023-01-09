<?php

namespace App\Models;

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
    protected $guared =[];
    use InteractsWithMedia;

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
}
