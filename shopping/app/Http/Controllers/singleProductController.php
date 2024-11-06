<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\general;
use App\Models\category;
use App\Models\brand;
class singleProductController extends Controller
{
    
    public function viewSingleProduct(string $id){
        
        $general = general::first();
        $categories = Category::with('sub_category')->get();
        $product = product::find($id);
        $products = product::get();
        $brand = brand::get();
        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });
        
        return view('fornt.single', compact('general', 'categoryData','product','brand','products'));
    }
}
