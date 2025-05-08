@extends('layouts.master')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Your Orders</h2>

    @if($orders->count())
        @foreach($orders as $order)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-lg font-medium text-gray-700">
                        Order #{{ $order->id }}
                    </h4>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <ul class="text-gray-600 space-y-1 mb-4">
                    @foreach($order->items as $item)
                        <li class="flex justify-between">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>{{ $item->price * $item->quantity }} DA</span>
                        </li>
                    @endforeach
                </ul>

                <div class="text-right text-gray-800 font-semibold">
                    Total: {{ $order->total_price }} DA
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-gray-500 mt-10">No orders found.</p>
    @endif
</div>
@endsection
