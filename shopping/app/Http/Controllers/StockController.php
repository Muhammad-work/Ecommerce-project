<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class StockController extends Controller
{
     public function viewStockProduct(){
       
          $product = product::get();

        return view('admin.stockProduct',compact('product'));
     }
}
