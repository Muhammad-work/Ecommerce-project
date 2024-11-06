<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function getBrandNameAttribute($value){
       return ucwords($value);
    }

    public function product(){
        return $this->hasMany(product::class);
    }
}
