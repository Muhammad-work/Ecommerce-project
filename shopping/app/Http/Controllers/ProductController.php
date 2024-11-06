<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\sub_category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['sub_category', 'brand'])->get();

        // Process and separate data
        $productData = $products->map(function ($product) {
            return [
                'product' => $product,
                'sub_categories' => $product->sub_category,
                'brand' => $product->brand
            ];
        });
 
        // return $productData;

        return view('admin.product', [
            'productData' => $productData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = brand::all();
        $sub_category = sub_category::all();
        return view('admin.add_product', ['brand' => $brand, 'sub_category' => $sub_category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'p_title' => 'required',
            'p_img' => 'required|mimes:jpg,jpeg,png',
            'p_brand' => 'required',
            'p_category' => 'required',
            'p_qtn' => 'required|integer|min:0',
            'status' => 'required',
            'p_des' => 'required',
            'p_price' => 'required|numeric',
        ]);
        
        // Store the uploaded image and get the storage path
        $path = $request->p_img->store('img', 'public');
        
        // Set default status to "out of stock" if quantity is zero
        $status = $request->p_qtn == 0 ? '0' : $request->status;
        
        // Create product with all fields, casting `p_descount` and `p_off` to strings
        product::create([
            'p_title' => $request->p_title,
            'p_des' => $request->p_des,
            'p_img' => $path,
            'brand_id' => $request->p_brand,
            'sub_category_id' => $request->p_category,
            'status' => $status,
            'p_qtn' => $request->p_qtn,
            'p_price' => $request->p_price,
           
        ]);
        
        // Redirect to product index route
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::find($id);

        $sub_category = sub_category::all();
        $brand = brand::all();

        return  view('admin.edit_product', ['product' => $product, 'sub_category' => $sub_category, 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $product = product::find($id);
        $request->validate([
            'p_title' => 'required',
            'p_brand' => 'required',
            'p_category' => 'required',
            'p_qtn' => 'required',
            'status' => 'required',
            'p_des' => 'required',
            'p_price' => 'required',
        ]);

        if ($request->hasFile('p_img')) {
            $img_path = public_path('storage/') . $product->p_img;
            if (file_exists($img_path)) {
                @unlink($img_path);
            }

            $path = $request->file('p_img')->store('img', 'public');
        } else {

            $path = $product->p_img;
        }

        $product->update([
            'p_title' => $request->p_title,
            'p_des' => $request->p_des,
            'p_img' => $path,
            'brand_id' => $request->p_brand,
            'sub_category_id' => $request->p_category,
            'status' => $request->status,
            'p_qtn' => $request->p_qtn,
            'p_price' => $request->p_price,
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);

        if(file_exists($product->p_img)){
            $img_path = public_path('storage/') . $product->p_img;
            @unlink($img_path);
        }
        $product->delete();
        return redirect()->route('product.index');
    }
}
