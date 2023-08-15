<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guared =[];

     // ------------------- Relationship ---------------------------//
     public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

     // ------------------- End Relationship ---------------------------//
}
