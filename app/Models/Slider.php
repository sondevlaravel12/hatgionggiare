<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// -----------end spatie media

class Slider extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guared =[];

    // ------------------- Spatie Media ---------------------------//
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('sliders')
            ->acceptsMimeTypes(['image/jpeg','image/png','image/svg'])
            ->onlyKeepLatest(3)
            ;

    }
    public function registerMediaConversions(Media $media = null): void
    {

        $this
            ->addMediaConversion('thumb')
            ->width(145)
            ->height(34);
        $this
            ->addMediaConversion('medium')
            ->width(435)
            ->height(185);
        $this
            ->addMediaConversion('large')
            ->width(870)
            ->height(370);
    }
    // -------------------End Spatie Media ---------------------------//

    public function getFirstImageUrl($size='large'){
        if($this->getFirstMedia('sliders')){
            return $this->getFirstMedia('sliders')->getUrl($size);
        }
        else{
            return asset('noimage.jpeg');
        }
    }
}

