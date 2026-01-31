<!-- Top Banner -->
<div class="top-banner">
    <div class="banner-content">
        <div class="banner-left">
            <p>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a href="#" class="shop-now">ShopNow</a></p>
        </div>
        <div class="banner-right">
            <select class="language-selector">
                <option>English</option>
                <option>Hindi</option>
                <option>Gujarati</option>
            </select>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="header-container">
        <!-- Logo -->
        <div class="logo">
            <a href="/">Exclusive</a>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-nav">
            <a href="/" class="nav-link active">Home</a>
            <a href="/contact" class="nav-link">Contact</a>
            <a href="/about" class="nav-link">About</a>
            @if(!Auth::check())
            <a href="{{route('signup')}}" class="nav-link">Sign Up</a>
            @else
            <a href="{{route('visitor.logout')}}" class="nav-link">Logout</a>
            @endif
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="What are you looking for?" class="search-input">
                <button class="search-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </div>
            <a href="/wishlist" class="icon-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </a>
            <a href="{{route('cart.index')}}" class="icon-link cart-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>
</header>
