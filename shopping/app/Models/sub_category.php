<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['s_c_name', 'category_id'];

    public function getSCNameAttribute($value){
        return ucwords($value);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function product(){
        return $this->hasMany(product::class);
    }
}
