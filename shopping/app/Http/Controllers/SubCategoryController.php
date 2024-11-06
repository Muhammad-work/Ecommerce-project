<?php

namespace App\Http\Controllers;

use App\Models\sub_category;
use App\Models\category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =sub_category::selectRaw('id as sub_id,s_c_name,category_id')->with('category',function($query){
            $query->selectRaw('id');
        })->get();
        return view('admin.sub_category',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::get();
        return view('admin.add_sub_category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'sub_category_name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id'
    ]);
    
    // Create a new sub-category
    sub_category::create([
        's_c_name' => $request->input('sub_category_name'),
        'category_id' => $request->input('category_id')
    ]);

    // Redirect to the sub-category index page with a success message
    return redirect()->route('sub-category.index')->with('success', 'Sub-category created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data = sub_category::selectRaw('id as sub_id,s_c_name,category_id')->with('category',function($query){
            $query->selectRaw('id,category_name as c_name');
        })->find($id);;
        $categories = category::get();
        // return $data;
         return view('admin.edit_sub_category',['data' => $data,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'sub_category_name' => 'required|string|max:255',
            'category_id' => 'required'
        ]);

        $data = sub_category::find($id);

        $data->update([
            's_c_name' => $request->input('sub_category_name'),
            'category_id' => $request->input('category_id')
        ]);

        return redirect()->route('sub-category.index')->with('success', 'Sub-category created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = sub_category::find($id);
        $data->delete();
        return redirect()->route('sub-category.index')->with('success', 'Sub-category created successfully!');
    }
}
