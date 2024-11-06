<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\general;
use App\Models\category;
use Illuminate\Support\Facades\Auth;


class addToCartController extends Controller
{
   
    public function mycart()
    {

        $general = general::first();
        $categories = Category::with('sub_category')->get();

        $categoryData = $categories->map(function ($category) {
            return [
                'category' => $category,
                'sub_category' => $category->sub_category,
            ];
        });

        return view('fornt.cart', compact('general', 'categoryData'));
    }


    public function addToCart(Request $request)
    {
    if (Auth::check()) {
            $product = Product::find($request->input('product_id'));

            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found!']);
            }

            $productId = $product->id;
         
            $quantity = $request->input('quantity', 1);
            // $product->p_qtn--;
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                return response()->json(['success' => false, 'message' => 'Product already in cart!']);
            }

            $cart[$productId] = [
                "id" => $productId,
                "user_id" => Auth::user()->id,
                'name' => $product->p_title,
                'img' => $product->p_img,
                'price' => $product->p_price,
                'brand' => $product->brand_id,
                'category' => $product->sub_category_id,
                "quantity" => $quantity,
            ];

            session()->put('cart', $cart);
        
            return response()->json(['success' => true, 'message' => 'Product added to cart Successfuly!']);
        } else {

            return response()->json(['success' => false, 'message' => 'Please log in to add items to your cart.', 'redirect' => route('login')]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'product_id' => 'required|integer',
            'action' => 'required|string|in:increase,decrease',
        ]);

        $cart = session()->get('cart', []);
        $product = Product::find($request->product_id); // Retrieve the product from the database

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }


        if (isset($cart[$request->product_id])) {
           
            if ($request->action === 'increase') {

                if ($cart[$request->product_id]['quantity'] < 5 && ($cart[$request->product_id]['quantity']) <= $product->p_qtn) {
                    $cart[$request->product_id]['quantity']++;
                    $product->p_qtn--;
                } else {
                    return response()->json(['success' => false, 'message' => 'Cannot exceed maximum limit or available stock. ']);
                }
            } elseif ($request->action === 'decrease') {
                if ($cart[$request->product_id]['quantity'] > 1) {
                    $cart[$request->product_id]['quantity']--;

                    $product->p_qtn++;
                } else {
                    return response()->json(['success' => false, 'message' => 'Quantity cannot be less than 1.']);
                }
            }

            session()->put('cart', $cart);
            $product->save();
            return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart.']);
    }


    public function remove(Request $request)
    {
        $product = Product::find($request->product_id);
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {

            $quantityInCart = $cart[$request->product_id]['quantity'] - 1;

            // Restore the stock
            $product->p_qtn += $quantityInCart;

            // Remove the product from the cart
            unset($cart[$request->product_id]);

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            // Save the updated product stock to the database
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product removed from cart successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart.']);
    }
}
