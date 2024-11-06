<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::id(); // Assuming user is authenticated
        $order->total = $request->total; // Total from the checkout
        $order->cart = json_encode(session('cart')); // Save cart items as JSON
        $order->save();

        // Clear the cart after order completion (optional)
        session()->forget('cart');

        return redirect()->back()->with(['success' => true, 'message' => 'Order placed successfully!']);
    }

    public function removeOrder(string $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('viewProfile')->with(['success' => true, 'message' => 'Order deleted successfully.']);
        } else {
            return redirect()->route('viewProfile')->with('error', 'Order not found.');
        }
    }
}
