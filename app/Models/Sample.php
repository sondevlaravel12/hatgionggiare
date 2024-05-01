<?php

namespace App\Models;

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


}
