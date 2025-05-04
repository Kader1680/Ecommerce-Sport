<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function checkout() {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) return back()->with('error', 'Cart is empty');

        DB::beginTransaction();
        try {
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'paid',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartItem::where('user_id', $user->id)->delete();
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error processing order');
        }
    }

    public function index() {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }
}