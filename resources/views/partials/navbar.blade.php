<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top main-navbar">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center animate__animated animate__fadeIn" href="{{ route('home') }}">
            <div class="brand-icon-wrapper me-2">
                <i class="bi bi-bag-heart-fill"></i>
            </div>
            <div class="brand-text">
                <span class="fw-bold text-navy">Toko</span><span class="fw-bold text-gold">kamikami</span>
            </div>
        </a>

        {{-- Mobile Toggles --}}
        <div class="d-flex align-items-center gap-2 d-lg-none">
            @auth
                <a href="{{ route('cart.index') }}" class="nav-link position-relative p-2">
                    <i class="bi bi-cart3 fs-5 text-navy"></i>
                    @if($cartCount)
                        <span class="badge rounded-pill bg-gold position-absolute top-0 start-100 translate-middle p-1"></span>
                    @endif
                </a>
            @endauth
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="bi bi-list fs-2 text-navy"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Bar Modern --}}
            <form class="mx-auto my-3 my-lg-0 w-100 search-form" action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group search-group">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-transparent border-0 shadow-none" name="q" placeholder="Cari koleksi eksklusif..." value="{{ request('q') }}">
                </div>
            </form>

            {{-- Menu Navigation --}}
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-bold {{ request()->routeIs('catalog.*') ? 'active' : '' }}" href="{{ route('catalog.index') }}">
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
                                <span class="badge rounded-pill bg-navy cart-badge text-gold">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="user-dropdown-toggle shadow-sm" data-bs-toggle="dropdown" href="#" role="button">
                            <img src="{{ auth()->user()->avatar_url }}" alt="User" class="avatar-img">
                            <div class="user-info d-none d-xl-block">
                                <span class="user-name">{{ explode(' ', auth()->user()->name)[0] }}</span>
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-4">
                            <li><h6 class="dropdown-header text-navy fw-bold">Halo, {{ auth()->user()->name }}!</h6></li>
                            <li><a class="dropdown-item rounded-3" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-gold"></i> Akun Saya</a></li>
                            <li><a class="dropdown-item rounded-3" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2 text-gold"></i> Pesanan Saya</a></li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <li><a class="dropdown-item rounded-3 text-navy fw-bold" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
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
                        <a class="nav-link fw-bold text-navy" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-navy rounded-pill px-4 shadow-sm fw-bold ms-lg-2 text-gold" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* CSS Variabel untuk Konsistensi Branding Tokokamikami */
:root {
    --navy-primary: #020617;
    --gold-accent: #fbbf24;
}

.text-navy { color: var(--navy-primary) !important; }
.text-gold { color: var(--gold-accent) !important; }
.bg-navy { background-color: var(--navy-primary) !important; }
.bg-gold { background-color: var(--gold-accent) !important; }
.btn-navy { background-color: var(--navy-primary); color: var(--gold-accent); border: none; transition: 0.3s; }
.btn-navy:hover { background-color: #0f172a; color: white; transform: translateY(-2px); }

/* Custom Navbar Styling */
.main-navbar {
    transition: all 0.3s ease;
    padding: 0.7rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
}

.brand-icon-wrapper {
    background: var(--navy-primary);
    color: var(--gold-accent);
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(2, 6, 23, 0.15);
}

.brand-text { font-size: 1.3rem; letter-spacing: -0.5px; }

/* Search Bar Modern */
.search-form { max-width: 400px !important; }
.search-group {
    background: #f1f5f9;
    border-radius: 15px;
    padding: 3px 10px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.search-group:focus-within {
    background: white;
    border-color: var(--gold-accent);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

/* Nav Links */
.nav-link {
    color: #475569 !important;
    font-size: 0.95rem;
    padding: 0.5rem 1.2rem !important;
    transition: 0.3s;
}
.nav-link:hover, .nav-link.active { color: var(--navy-primary) !important; }
.nav-link.active::after {
    content: '';
    display: block;
    width: 20px;
    height: 3px;
    background: var(--gold-accent);
    border-radius: 10px;
    margin: -5px auto 0;
}

/* User Dropdown */
.user-dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    padding: 6px 15px;
    background: white;
    border-radius: 50px;
    border: 1px solid #f1f5f9;
    transition: 0.3s;
}
.user-dropdown-toggle:hover { border-color: var(--gold-accent); background: #fdfcfb; }
.avatar-img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #e2e8f0;
}
.user-name { font-size: 0.85rem; font-weight: 700; color: var(--navy-primary); }

/* Icon Link Badge */
.icon-link { font-size: 1.3rem; color: var(--navy-primary) !important; }
.badge-dot {
    position: absolute;
    top: 10px;
    right: 8px;
    width: 8px;
    height: 8px;
    background: var(--gold-accent);
    border-radius: 50%;
    border: 2px solid white;
}
.cart-badge {
    position: absolute;
    top: 0;
    right: -5px;
    font-size: 0.6rem;
    padding: 0.4em 0.6em;
    font-weight: 800;
}

/* Dropdown Menu Item */
.dropdown-item {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.7rem 1rem;
    color: #475569;
}
.dropdown-item:hover {
    background-color: #f8fafc;
    color: var(--navy-primary);
}

/* Mobile Fix */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: white;
        padding: 2rem;
        border-radius: 25px;
        margin-top: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid #f1f5f9;
    }
}
</style>
