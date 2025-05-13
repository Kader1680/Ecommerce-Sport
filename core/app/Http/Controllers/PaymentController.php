<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id|unique:payments,order_id',
        'amount' => 'required|numeric|min:1',
        'ccp_number' => 'nullable|string',
        'cle_rib' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    $payment = Payment::create([
        'order_id' => $request->order_id,
        'amount' => $request->amount,
        'ccp_number' => $request->ccp_number,
        'cle_rib' => $request->cle_rib,
        'description' => $request->description,
        'payment_method' => 'ccp'
    ]);

    return back()->with('success', 'Paiement enregistré avec succès.');
}


}
