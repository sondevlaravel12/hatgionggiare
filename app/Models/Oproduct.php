<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oproduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
    //  other functions
    public static function search($term){
        $term = mb_strtolower(trim($term));
        //$term = json_encode($term, JSON_UNESCAPED_UNICODE);
        $results = Oproduct::where('name', 'like', '%'.$term.'%')->get();
        // $arrResut = array();
        // if($results->count()>0){
        //     foreach($results as $result){
        //         $name= $result->name;
        //         $arrResut[] = $name;
        //     }
        // }

        // return $arrResut;
        return $results;
    }

    // end other functions
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
            set: fn ($value) => mb_strtolower($value, 'UTF-8'),
        );
    }
}
