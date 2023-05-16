<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ------------spatie media
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
// -----------end spatie media

class Slider extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded =[];

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
            ->fit(Manipulations::FIT_FILL, 145, 62, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            ->format('png');
        $this
            ->addMediaConversion('medium')
            ->fit(Manipulations::FIT_FILL, 435, 185, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            ->format('png');
        $this
            ->addMediaConversion('large')
            ->fit(Manipulations::FIT_FILL, 870, 370, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            ->format('png');
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

