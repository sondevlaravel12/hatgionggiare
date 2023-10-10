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
    //  other functions
    public static function search($term){
        $term = mb_strtolower(trim($term));
        //$term = json_encode($term, JSON_UNESCAPED_UNICODE);
        $results = Tag::where('name', 'like', '%'.$term.'%')->get('name');
        $arrResut = array();
        if($results->count()>0){
            foreach($results as $result){
                $name= $result->name;
                $arrResut[] = $name;
            }
        }

        return $arrResut;
    }

    // end other functions
}
