<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\general;
use App\Models\category;
use App\Models\user;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class userController extends Controller
{
    public function viewProfile(){
        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });

        $orders = Order::whereDate('created_at', today())->where('user_id' ,'=', Auth::user()->id)->get();
        
        return view('fornt.userProfile', compact('general', 'categoryData','orders'));
    }

    public function updateUserImg(Request $request, string $id){
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $user = user::findOrFail($id);
       
        if ($request->hasFile('profile_image')) {
           
            $img_path = public_path('storage/') . $user->img;
            if (file_exists($img_path)) {
                @unlink($img_path);
            }

          
            $path = $request->file('profile_image')->store('img', 'public');
            $user->img = $path;
          
        }     
        $user->save();
       return redirect()->back()->with('success', 'Profile image updated successfully!');
    }

    public function viewEditPage(string $id){
        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });
        $user = user::findOrFail($id);
        return view('fornt.editUser',compact('user','general', 'categoryData'));
    }

    public function storeUser(Request $req, string $id){
        $user = user::findOrFail($id);

        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
        ]);

        return redirect()->route('viewProfile');
    }

    public function viewAllOrders(){
        $orders = Order::where('user_id' ,'=', Auth::user()->id)->get();
        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });
        return view('fornt.orders',compact('orders','general', 'categoryData'));
    }

    
}
