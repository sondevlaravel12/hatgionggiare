<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;



class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];


    ////  ------------------ Accessor--------------------------------- ////
    protected function expiry(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y, H:i'),
        );
    }
    ////  ------------------ End Accessor--------------------------------- ////
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->getRawOriginal('expiry'));
    }
}
