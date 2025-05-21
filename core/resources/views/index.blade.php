@extends("layouts.master")

@section("content")

<style>
.products-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.product-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1rem;
    height: 100%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-card img {
    height: 200px;
    object-fit: cover;
    margin-bottom: 1rem;
    border-radius: 6px;
}

.product-card h3 {
    margin: 0.5rem 0;
}

.product-card p {
    margin-bottom: 0.5rem;
    flex-grow: 1;
    font-size: 1.2rem;
    color: #555;
}

.buy-btn {
    background-color: #000;
    color: white;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 5px;
    cursor: pointer;
    margin-top: auto;
    transition: background-color 0.3s ease;
}

.buy-btn:hover {
    background-color: #333;
}

.categories {

    
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin: 2rem 0 1rem;
}

.categories a {
    text-decoration: none;
    background-color: #ff8b8b;
    font-size: 1.2rem;

    padding: 0.7rem 1.5rem;
    border-radius: 30px;
    font-weight: 600;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.categories a:hover {
    background-color: #000;
    color: #fff;
}
</style>

<section class="hero-section">
    <h1>ELEVATE YOUR GAME</h1>
    <h2>WITH <span>PREMIUM</span> SPORTSWEAR</h2>
    <p>Discover top-quality sports apparel and gear designed for ultimate comfort and performance.</p>
    <a href="shop.html"><button class="shop-btn">SHOP NOW</button></a>
</section>

<div class="categories">

    <a href="{{route("filter", 'All-Products')}}">All Products</a>

    @foreach ($allcategories as $category)
    <a href="{{route("filter", $category->name)}}">{{$category->name}}</a>
    @endforeach

    
  
</div>

<section class="product" id="products">
    <h2 style="text-align: center;">Our Products</h2>
    <div class="products-container">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="price">${{ $product->price }}</p>
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
