<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::get();
        return view('admin.category',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $data = $req->validate([
            'category_name' => 'required'
        ]);
       
        $categoryName = $data['category_name'];

        category::create([
            'category_name' => $categoryName,
            'post' => 0
        ]);
      
        return redirect()->route('category.index')->with(['status' => 'alert("Add category Succssfuly")']);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data = category::find($id);
         return view('admin.edit_category',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = category::find($id);
        
        $new = $data->update([
            'category_name' => $request->category_name,
            'post' => 0 
        ]);
        return redirect()->route('category.index')->with(['status' => 'alert("Add category Succssfuly")']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->route('category.index')->with(['status' => 'alert("Add category Succssfuly")']); 
    }
}
