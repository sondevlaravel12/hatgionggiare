<?php

namespace App\Models;

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
}
