@extends("layouts.master")
@section("content")
<section class="hero-section">
    <h1>ELEVATE YOUR GAME</h1>
    <h2>WITH <span>PREMIUM</span> SPORTSWEAR</h2>
    <p>Discover top-quality sports apparel and gear designed for ultimate comfort and performance.</p>
    
    <a href="shop.html"><button class="shop-btn">SHOP NOW</button></a>
</section>

<section class="product" id="products">
    <h2>Our Products</h2>
    <div class="products-container">

        @foreach ($products as $product)
            <div class="product">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="price">{{ $product->price }}</p>
                <p>{{ $product->description }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="buy-btn">Add to Cart</button>
                </form>
                
            </div>
        @endforeach

    </div>
</section>
@endsection
