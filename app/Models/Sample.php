<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Sample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // ---------relationship
    public function oproduct()
    {
        return $this->belongsTo(Oproduct::class);
    }
    // sample belong post, product One to One (Polymorphic)
    public function sampleable(): MorphTo
    {
        return $this->morphTo();
    }
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
            set: fn ($value) => mb_strtolower($value, 'UTF-8'),
        );
    }


}
