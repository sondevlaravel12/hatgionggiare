<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded =['id'];

     // ------------------- Relationship ---------------------------//
     public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

     // ------------------- End Relationship ---------------------------//
}
