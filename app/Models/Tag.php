<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded =['id'];

     // ------------------- Relationship ---------------------------//
     public function products()
     {
         return $this->morphedByMany(Product::class, 'taggable');
     }
     public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

     // ------------------- End Relationship ---------------------------//
    // ------------------------------ Mutators & Casting ---------------//
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value,true)['vi-VN'],
            set: fn ($value) => '{"vi-VN": "' .$value .'"}',
        );
    }
    // ------------------------------ End Mutators & Casting ---------------//
    //  other functions
    public static function search($term){
        $term = mb_strtolower(trim($term));
        //$term = json_encode($term, JSON_UNESCAPED_UNICODE);
        // $results = Tag::where('name', 'like', '%'.$term.'%')->get('name');
        $results = Tag::where('name->vi-VN', 'like', '%'.$term.'%')->get('name');
        $arrResut = array();
        if($results->count()>0){
            foreach($results as $result){
                $name= json_decode($result->name,true)['vi-VN'];
                $arrResut[] = $name;
            }
        }

        return $arrResut;
    }

    // end other functions
}
