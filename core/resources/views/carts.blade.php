@extends('layouts.master')

@section('content')
<style>
    .cart-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }

    .cart-container h2 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #f5f5f5;
    }

    .place-order-btn {
        background-color: #28a745;
        color: white;
        padding: 8px 15px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .place-order-btn:hover {
        background-color: #218838;
    }

    .empty-message {
        color: #666;
        font-size: 16px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
    }

    .quantity-btn {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        padding: 5px 10px;
        cursor: pointer;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        margin: 0 5px;
    }

    .remove-btn {
        background-color: #dc3545;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }

    .remove-btn:hover {
        background-color: #c82333;
    }

    .total-row {
        font-weight: bold;
        background-color: #f9f9f9;
    }
</style>

<div class="cart-container">
    <h2>Your Cart</h2>

    @if($cartItems->count())
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }} DA</td>
                    <td>
                        <div class="quantity-controls">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="quantity-btn minus" data-item="{{ $item->id }}">-</button>
                                <input type="number" name="quantity" class="quantity-input" value="{{ $item->quantity }}" min="1" data-item="{{ $item->id }}">
                                <button type="button" class="quantity-btn plus" data-item="{{ $item->id }}">+</button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $item->product->price * $item->quantity }} DA</td>
                    <td>
                        <form action="{{ route('checkout', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="place-order-btn">Order This</button>
                        </form>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    {{-- <td>{{ $totalPrice }} DA</td> --}}
                    <td>
                        <form action="{{ route('checkout.all') }}" method="POST">
                            @csrf
                            <button type="submit" class="place-order-btn">Order All</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p class="empty-message">Your cart is empty.</p>
    @endif
</div>

 
@endsection