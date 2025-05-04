<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    public function index() {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Product $product) {
        $item = CartItem::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return back();
    }

    public function remove($id) {
        CartItem::where('id', $id)->where('user_id', Auth::id())->delete();
        return back();
    }
}