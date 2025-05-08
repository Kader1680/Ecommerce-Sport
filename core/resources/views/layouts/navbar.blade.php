<nav class="navbar">
  <div class="logo">GYMSTORE</div>

  <ul class="nav-links">
      <li><a href="/">Home</a></li>
      {{-- <li><a href="#men">Men</a></li>
      <li><a href="#women">Women</a></li>
      <li><a href="#fitness">Fitness Accessories</a></li>
      <li><a href="#about">About Us</a></li> --}}
      <li class="divider">|</li>

      <li>
          <a href="/cart" class="cart">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-count">{{ $cartCount }}</span>
              carts
          </a>
      </li>
      <li><a href="/orders">orders</a></li>
      <li><a href="/admin/dashboard">dashboard</a></li>


      @auth
          @if (Auth::user()->is_admin)
              <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          @endif

          <li>
              <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                  @csrf
                  <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer;">Logout</button>
              </form>
          </li>
      @else
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
      @endauth
  </ul>
</nav>
