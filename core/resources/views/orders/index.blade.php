@extends('layouts.master')
<style>
    .container {
    max-width: 800px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
}

.title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #333;
}

.alert-success {
    background-color: #e6ffed;
    color: #2d7a46;
    padding: 15px;
    border: 1px solid #b2f5b2;
    border-radius: 5px;
    margin-bottom: 20px;
}

.order-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.order-id {
    font-size: 18px;
    color: #444;
}

.order-status {
    font-size: 14px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 20px;
    text-transform: capitalize;
}

.order-status.paid {
    background-color: #d4f5dc;
    color: #217a3d;
}

.order-status.pending {
    background-color: #fff3cd;
    color: #856404;
}

.order-items {
    list-style: none;
    padding: 0;
    margin-bottom: 15px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    color: #555;
    margin-bottom: 5px;
}

.order-total {
    text-align: right;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
}

.btn-confirm {
     
    color: white;
    font-size: 33px
    padding: 10px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-delete {
    background-color: #ff0044;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-confirm:hover {
    background-color: #17b174;
rgba(23, 177, 115, 0.732)
}

.no-orders {
    text-align: center;
    color: #888;
    margin-top: 50px;
}


.order-status {
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
}

.status-canceled {
    background-color: #ff8787;
    color: #721c24;
}

.status-default {
    background-color: #f7f4c5;
    color: #c5a100;
}


.status-paid {
    background-color: #34dd86;
    color: #0e8547;
}


.confrim{
    padding: 11px 30px;
    height: fit-content;
    background-color: #17b174;
    font-size: 16px;
}


</style>
@section('content')
<div class="container">
    <h2 class="title">Your Orders</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count())
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <h4 class="order-id">Order #{{ $order->id }}</h4>
                    <span class="order-status 
                        {{ strtolower($order->status) === 'canceled' ? 'status-canceled' : '' }}
                        {{ strtolower($order->status) === 'paid' ? 'status-paid' : '' }}
                        {{ !in_array(strtolower($order->status), ['paid', 'canceled']) ? 'status-default' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                        
                                
                </div>

                <ul class="order-items">
                    @foreach($order->items as $item)
                        <li class="order-item">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>{{ $item->price * $item->quantity }} DA</span>
                        </li>
                    @endforeach
                </ul>

                <div class="order-total">
                    Total: {{ $order->total_price }} DA
                </div>

                @if($order->status !== 'paid' && $order->status !== 'canceled')
                  <div style="display: flex;">
                      <button  type="submit" class="btn-confirm confrim"><a style="color: white" href="{{'payment/'. $order->id}}">confirm</a></button>    
                    </form> --}}
                    <form style="margin-left:1rem" action="{{ route('order.cancel', $order->id) }}" method="POST">
                        @csrf
                       
                        <button style="font-size: 16px; " type="submit" class="btn-delete">cancel Order</button>
                    </form>
                  </div>
                @endif



            </div>
        @endforeach
    @else
        <p class="no-orders">No orders found.</p>
    @endif
</div>
@endsection
