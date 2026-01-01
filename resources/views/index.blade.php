@extends("layouts.master")

@section("content")

<style>
    :root {
        --primary-color: #1a1a1a;
        --accent-color: #ff4747; /* Energetic Red/Orange */
        --bg-light: #f8f9fa;
        --text-muted: #6c757d;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* Hero Section Refinement */
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&q=80&w=2070') center/cover;
        height: 60vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 0 20px;
        border-radius: 0 0 20px 20px;
    }

    .hero-section h1 { font-size: 3rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 0.5rem; }
    .hero-section h2 span { color: var(--accent-color); }
    .hero-section p { font-size: 1.1rem; max-width: 600px; opacity: 0.9; margin-bottom: 2rem; }
    
    .shop-btn {
        background-color: #fff;
        color: #000;
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition);
    }
    .shop-btn:hover { transform: scale(1.05); background-color: var(--accent-color); color: #fff; }

    /* Categories - Responsive Scrollable Row */
    .categories {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 3rem 0;
        overflow-x: auto;
        padding-bottom: 10px;
        scrollbar-width: none; /* Hide scrollbar Firefox */
    }
    .categories::-webkit-scrollbar { display: none; } /* Hide scrollbar Chrome/Safari */

    .categories a {
        text-decoration: none;
        background-color: #fff;
        color: var(--primary-color);
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        font-weight: 600;
        border: 1px solid #eee;
        white-space: nowrap;
        transition: var(--transition);
    }

    .categories a:hover {
        background-color: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
    }

    /* Product Grid */
    .products-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2.5rem;
        padding: 0 5%;
        margin-bottom: 5rem;
    }

    .product-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f1f1;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow);
    }

    .image-wrapper {
        position: relative;
        overflow: hidden;
        background: #f5f5f5;
        height: 300px;
    }

    .product-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    .product-info {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-card h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--accent-color);
        margin-bottom: 0.5rem;
    }

    .description {
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.4;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .buy-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        width: 100%;
        padding: 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .buy-btn:hover {
        background-color: #333;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section h1 { font-size: 2rem; }
        .categories { justify-content: flex-start; padding-left: 5%; }
        .products-container { grid-template-columns: 1fr 1fr; gap: 1rem; padding: 0 15px; }
        .image-wrapper { height: 200px; }
    }
</style>

<section class="hero-section">
    <h1>ELEVATE YOUR GAME</h1>
    <h2>WITH <span>PREMIUM</span> SPORTSWEAR</h2>
    <p>Discover top-quality sports apparel and gear designed for ultimate comfort and high-performance athletes.</p>
    <a href="#products"><button class="shop-btn">Explore Collection</button></a>
</section>

<div class="categories">
    <a href="{{route('filter', 'All-Products')}}">All Products</a>
    {{-- Example Loop --}}
    @isset($allcategories)
        @foreach ($allcategories as $category)
        <a href="{{route('filter', $category->name)}}">{{$category->name}}</a>
        @endforeach
    @endisset
</div>

<section id="products">
    <h2 style="text-align: center; margin-bottom: 3rem; font-weight: 800;">FEATURED GEAR</h2>
    <div class="products-container">
        @foreach ($products as $product)
            <div class="product-card">
                <div class="image-wrapper">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    @else
                        <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#ccc;">No Image</div>
                    @endif
                </div>
                
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">${{ number_format($product->price, 2) }}</p>
                    <p class="description">{{ $product->description }}</p>
                    
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin-top:auto;">
                        @csrf
                        <button type="submit" class="buy-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection