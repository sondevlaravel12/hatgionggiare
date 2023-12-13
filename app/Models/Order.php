<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    ////  ------------------ Accessor--------------------------------- ////
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 0, ',', '.') .' đ',
        );
    }
    // ----------------------end Accessor ----------------------------//
    public static function getArrayStatus(){
        $result = [
            'pending' =>'Chờ xử lý',
            'processing' =>'Đang xử lý',
            'decline' =>'Hủy bỏ',
            'completed' =>'Hoàn tất'
        ];
        return $result;
    }
}
