<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top main-navbar">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div class="brand-icon-wrapper me-2">
                <i class="bi bi-bag-heart-fill"></i>
            </div>
            <div class="brand-text">
                <span class="fw-bold text-primary">Toko</span><span class="fw-bold text-dark">kamikami</span>
            </div>
        </a>

        {{-- Mobile Toggles --}}
        <div class="d-flex align-items-center gap-2 d-lg-none">
            @auth
                <a href="{{ route('cart.index') }}" class="nav-link position-relative p-2">
                    <i class="bi bi-cart3 fs-5"></i>
                    @if($cartCount)
                        <span class="badge rounded-pill bg-primary position-absolute top-0 start-100 translate-middle p-1"></span>
                    @endif
                </a>
            @endauth
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="bi bi-list fs-2"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Bar Modern --}}
            <form class="mx-auto my-3 my-lg-0 w-100 search-form" action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group search-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0 shadow-none" name="q" placeholder="Cari produk impianmu..." value="{{ request('q') }}">
                </div>
            </form>

            {{-- Menu Navigation --}}
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->routeIs('catalog.*') ? 'active' : '' }}" href="{{ route('catalog.index') }}">
                        Katalog
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item">
                        <a class="nav-link icon-link" href="{{ route('wishlist.index') }}" title="Wishlist">
                            <i class="bi bi-heart"></i>
                            @if(auth()->user()->wishlists()->count())
                                <span class="badge-dot"></span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item me-lg-2">
                        <a class="nav-link icon-link cart-icon" href="{{ route('cart.index') }}" title="Keranjang">
                            <i class="bi bi-cart3"></i>
                            @if($cartCount)
                                <span class="badge rounded-pill bg-primary cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                            <img src="{{ auth()->user()->avatar_url }}" alt="User" class="avatar-img">
                            <div class="user-info d-none d-xl-block">
                                <span class="user-name">{{ explode(' ', auth()->user()->name)[0] }}</span>
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-4">
                            <li><h6 class="dropdown-header">Halo, {{ auth()->user()->name }}!</h6></li>
                            <li><a class="dropdown-item rounded-3" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Akun Saya</a></li>
                            <li><a class="dropdown-item rounded-3" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2"></i> Pesanan</a></li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <li><a class="dropdown-item rounded-3 text-primary fw-bold" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                            @endif

                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item rounded-3 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold ms-lg-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* Custom Navbar Styling */
.main-navbar {
    transition: all 0.3s ease;
    padding: 0.8rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.brand-icon-wrapper {
    background: var(--bs-primary);
    color: white;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 1.1rem;
    box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
}

.brand-text { font-size: 1.25rem; letter-spacing: -0.5px; }

/* Search Bar Modern */
.search-form { max-width: 450px !important; }
.search-group {
    background: #f3f4f6;
    border-radius: 12px;
    padding: 2px 8px;
    transition: all 0.3s ease;
}
.search-group:focus-within {
    background: white;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
}

/* Nav Links */
.nav-link {
    color: #4b5563 !important;
    position: relative;
    padding: 0.5rem 1rem !important;
    transition: color 0.3s ease;
}
.nav-link:hover, .nav-link.active { color: var(--bs-primary) !important; }

/* User Dropdown */
.user-dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    padding: 5px 12px;
    background: #f9fafb;
    border-radius: 50px;
    transition: background 0.3s ease;
}
.user-dropdown-toggle:hover { background: #f3f4f6; }
.avatar-img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
}
.user-name { font-size: 0.85rem; font-weight: 600; color: #374151; }

/* Icon Link Badge */
.icon-link { font-size: 1.25rem; padding: 0.5rem !important; position: relative; }
.badge-dot {
    position: absolute;
    top: 10px;
    right: 8px;
    width: 8px;
    height: 8px;
    background: #ef4444;
    border-radius: 50%;
    border: 2px solid white;
}
.cart-badge {
    position: absolute;
    top: 2px;
    right: -2px;
    font-size: 0.65rem;
    padding: 0.35em 0.6em;
}

/* Responsive Fixes */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: white;
        padding: 1.5rem;
        border-radius: 20px;
        margin-top: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
}
</style>
