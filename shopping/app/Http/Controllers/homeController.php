<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\general;
use App\Models\category;
use App\Models\product;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class homeController extends Controller
{
    public function viewHome()
    {

        $general = general::first();

        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });

        $products = Product::orderBy('id')->take(4)->get(); 
        $products_new = Product::orderBy('id')->skip(4)->take(4)->get(); 
        
        return view( 'fornt.home', compact(['general', 'categoryData', 'products','products_new']));

       
    }

    public function login()
    {

        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });

        return view('fornt.login', compact('general', 'categoryData'));
    }

    public function signup()
    {
        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });

        return view('fornt.signup', compact('general', 'categoryData'));
    }


    
    public function storesignup(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|size:11',
            'address' => 'required',
            'password' => 'required|Confirmed|max:8|min:6',
        ]);

        user::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('login');
    }

    public function storeLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:8|min:6',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashbord');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        return redirect('/')->with('status', 'Logged out successfully!');
    }

    public function viewAbout(){
        
        $general = general::first();

        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });
        return view( 'fornt.about', compact(['general', 'categoryData']));
    }

    public function search(Request $req) {


        $general = general::first();
    $categories = Category::with('sub_category')->get();

    $categoryData = $categories->map(function ($category) {
        return [
            'category' => $category,
            'sub_category' => $category->sub_category,
        ];
    });

    
    $keyword = $req->input('keyword');
    $categoryId = $req->input('category');
    // return $categoryId;

    
    $query = product::query();

    
    if ($categoryId) {
        $query->where('sub_category_id', $categoryId);
    }

 
    if ($keyword) {
        $query->where('p_title', 'LIKE', "%{$keyword}%");
    }

    
    $products = $query->get();

   
    if ($products->isEmpty() && $keyword) {
        
        $subCategoryIds = product::where('p_title', 'LIKE', "%{$keyword}%")
            ->pluck('sub_category_id')
            ->unique();
        $products = product::whereIn('sub_category_id', $subCategoryIds)->get();
    }

  
    return view('fornt.search', compact('general', 'categoryData', 'products', 'keyword','categoryId'));
    }

   

   
}
