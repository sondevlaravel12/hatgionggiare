<?php

namespace App\Traits;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

trait HasMediaConversions
{

    public function registerMediaConversionsTrait(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_FILL, 100, 100, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            // ->border('000', 10)
            ->format('png');
        $this
            ->addMediaConversion('medium')
            ->fit(Manipulations::FIT_FILL, 300, 300, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            // ->border('000', 10)
            ->format('png');
        $this
            ->addMediaConversion('large')
            ->fit(Manipulations::FIT_FILL, 600, 600, function ($constraint) {
                $constraint->upsize();
            })
            ->background('fff')
            // ->border('000', 10)
            ->format('png');
    }
}
