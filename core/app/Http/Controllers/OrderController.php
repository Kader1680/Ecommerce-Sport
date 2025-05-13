<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class OrderController extends Controller
{
    // public function checkoutAll()
    // {
    //     $user = Auth::user();
    //     $cartItems = CartItem::where('user_id', $user->id)->with('products')->get();
        
    //     if ($cartItems->isEmpty()) {
    //         return back()->with('error', 'Your cart is empty');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            
    //         $order = Order::create([
    //             'user_id' => $user->id,
    //             'total_price' => $total,
    //             'status' => 'pending',
    //         ]);

    //         foreach ($cartItems as $item) {
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $item->product_id,
    //                 'quantity' => $item->quantity,
    //                 'price' => $item->product->price,
    //             ]);
    //         }

    //         CartItem::where('user_id', $user->id)->delete();
            
    //         // DB::commit();
            
    //         return redirect()->route('orders')->with('success', 'Order placed successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Failed to process order: ' . $e->getMessage());
    //     }
    // }

    public function checkoutItem($itemId)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)
                          ->where('id', $itemId)
                          ->with('product')
                          ->first();

        if (!$cartItem) {
            return back()->with('error', 'Item not found in your cart');
        }

        

        $total = $cartItem->product->price;

        // dd($total)
        
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);

        $cartItem->delete();


        // // DB::beginTransaction();

        // try {
        //     $total = $cartItem->product->price * $cartItem->quantity;
            
        //     $order = Order::create([
        //         'user_id' => $user->id,
        //         'total_price' => $total,
        //         'status' => 'pending',
        //     ]);

        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $cartItem->product_id,
        //         'quantity' => $cartItem->quantity,
        //         'price' => $cartItem->product->price,
        //     ]);

        //     // $cartItem->delete();
            
        //     // DB::commit();
            
        //     return redirect()->route('orders')->with('success', 'Item ordered successfully!');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return back()->with('error', 'Failed to process item order: ' . $e->getMessage());
        // }
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                    //   ->with('items.product')
                      ->orderBy('created_at', 'desc')
                      ->get();           
        // $orderlists = OrderItem::where('order_id', $orders->id)
                    //   ->get();

        return view('orders.index', compact('orders'));
     
    }

     public function delete($id)
    {
        $orders = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->first();
        
        if(!$orders){
            return redirect()->route('orders.index')->with('error', 'Commande introuvable ou non autorisée.');
        }
          
        $orders->delete();
                      
        return view('orders.index', compact('orders'));
     
    }
}