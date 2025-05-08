<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

//     public function countcart(){
//     $cartCount = 0;

//     if (Auth::check()) {
//         $cartCount = CartItem::where('user_id', Auth::id())->count();
//     }

//     return view('layouts.navbar', compact('cartCount'));
// }


    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        return view('carts', compact('cartItems'));
    }

    public function add(Product $product)
    {
        $item = CartItem::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($item) {
            $item->quantity++;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect("carts");
    }

    public function placeOrder()
    {
        CartItem::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Order placed successfully!');
    }
}
