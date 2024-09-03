<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatorder extends Model
{
    use HasFactory;
    protected $guarded =[];
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
