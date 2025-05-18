<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{



public function submit(Request $request, $id)
{
    // $request->validate([
    //     'order_id' => 'required|exists:orders,id|unique:payments,order_id',
    //     'amount' => 'required|numeric|min:1',
    //     'ccp_number' => 'nullable|string',
    //     'cle_rib' => 'nullable|string',
    // ]);


    $order = Order::where('user_id', Auth::id())
                    ->where('id', $id)
                    ->firstOrFail();

     
    

    $payment = Payment::create([
        'order_id' => $order->id,
        'amount' => $order->total_price,
        'ccp_number' => $request->ccp_number,
        'cle_rib' => $request->cle_rib,
    ]);

    $order->update(['status' => 'paid']);
    return redirect()->route('orders.index')->with('success', 'Paiement enregistré avec succès.');

   


}


public function showPaymentForm($orderId)
{
    $order = Order::findOrFail($orderId);
    return view('payment', compact('order'));
}



}
