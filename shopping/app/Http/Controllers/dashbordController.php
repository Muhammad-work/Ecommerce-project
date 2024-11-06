<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\sub_category;
use App\Models\brand;
use App\Models\Order;
use App\Models\user ;
use Illuminate\Support\Facades\Mail;
use App\Mail\customerMail;
use Illuminate\Http\Request;

class dashbordController extends Controller
{
    public function viewDashbord()
    {

        $productCount = product::count();
        $userCount = user::where('role','user')->count();
        $OrderCount = order::where('status','pendding')->count();
        $products = Product::with(['sub_category', 'brand'])->get();

        // Process and separate data
        $productData = $products->map(function ($product) {
            return [
                'product' => $product,
                'sub_categories' => $product->sub_category,
                'brand' => $product->brand
            ];
        });

        $orders = order::with('user')->get();

        return view('admin.dashbord', compact('productData', 'productCount','userCount','OrderCount'));
    }

    public function editOutOFStockProduct(string $id)
    {
        $product = product::find($id);

        $sub_category = sub_category::all();
        $brand = brand::all();
        return  view('admin.edit_outStock', ['product' => $product, 'sub_category' => $sub_category, 'brand' => $brand]);
    }

    public function updateOutOFStockProduct(Request $request, string $id)
    {
        $product = product::find($id);

        $request->validate([
            'p_title' => 'required',
            'p_brand' => 'required',
            'p_category' => 'required',
            'p_qtn' => 'required',
            'status' => 'required',
            'p_des' => 'required',
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
        ]);

        return redirect()->route('dashbord');
    }

    public function destroyOutOfStock(string $id)
    {
        $product = product::find($id);

        $img_path = public_path('storage/') . $product->p_img;
        if (file_exists($img_path)) {
            @unlink($img_path);
        }
        $product->delete();
        return redirect()->route('dashbord');
    }


    public function allOrder(){
        $orders = order::where('status','down')->with('user')->get();
        return view('admin.allorder',compact('orders'));
    }

    public function viewallOrders(string $id){

        $orders = order::where('user_id',$id)->where('status','down')->get();
        return view('admin.viewallorder',compact('orders'));
    }


    public function viewOrder(){
        $orders = order::where('status','pendding')->with('user')->get();
        return view('admin.order',compact('orders'));
    }
    
    public function viewTodayOrders(string $id){

        $orders = order::where('user_id',$id)->where('status','pendding')->get();
        return view('admin.userorder',compact('orders'));
    }

    public function deliverOrder(string $id){
        $orders = Order::with('user')->find($id);
        $orders->update([
            'status' => 'down'
        ]);
     
        $orderEmail = $orders['user']->email;
        $orderName = $orders['user']->name;
        $tosendmail = $orderEmail;
        $message = 'Hi ' .  $orderName . " we hope you're enjoying your recent purchase from UMA IMPORT INC.! Your feedback is incredibly valuable to us and helps us to keep improving. If you could take a moment to leave a review, we’d really appreciate it! Click [here to leave a review]. Thank you!";
        $subject = 'How was your experience with us ?';
        
        Mail::to($tosendmail)->send(new customerMail($message, $subject));

        return redirect()->route('viewOrder');
    }
    public function cancelrOrder(string $id){
        $orders = order::find($id);
        $orders->delete();
        return redirect()->route('viewOrder');
    }

    public function viewusertabele(){
        $users = user::where('role','user')->get();
        return view('admin.userTable',compact('users'));
    }

    public function deleteUser(string $id){
    
        $users = user::where('id',$id)->delete();

        return redirect()->route('viewusertabele');
    }
}
