<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','post'];

    public $timestamps = false;

    public function getCategoryNameAttribute($value){
        return ucwords($value);
    }

    
    public function sub_category(){
        return $this->hasMany(sub_category::class);
    }

}
