<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
class product extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $fillable = [
      'p_title',
      'p_des',
      'p_img',
      'brand_id',
      'sub_category_id',
      'status',
      'p_qtn',
      'p_price'
    ]; 

    

    public function getPTitleAttribute($value){
        return ucwords($value);
    }

    // public function getPPriceAttribute($value){
    //     return Number::format($value);
    // }
    

    public function sub_category(){
        return $this->belongsTo(sub_category::class);
    }
    public function Brand(){
        return $this->belongsTo(brand::class);
    }
}
