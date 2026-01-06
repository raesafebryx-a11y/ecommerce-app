<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top"
     style="border-bottom: 1px solid #f0f0f0;">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand fw-semibold d-flex align-items-center text-primary"
           href="{{ route('home') }}">
            <i class="bi bi-bag-heart-fill me-2 fs-5"></i>
           <span class="fw-bold">Toko</span><span class="text-dark">kamikami</span>

        </a>

        {{-- Toggle --}}
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Search --}}
            <form class="mx-lg-auto my-3 my-lg-0 w-100"
                  style="max-width: 380px"
                  action="{{ route('catalog.index') }}"
                  method="GET">
                <div class="input-group input-group-sm">
                    <input type="text"
                           class="form-control"
                           name="q"
                           placeholder="Cari produk..."
                           value="{{ request('q') }}">
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Menu --}}
            <ul class="navbar-nav ms-lg-auto align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid me-1"></i> Katalog
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item position-relative">
                        <a class="nav-link px-2" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart"></i>
                            @if(auth()->user()->wishlists()->count())
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"
                                      style="font-size: 0.55rem;">
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
                    <li class="nav-item position-relative">
                        <a class="nav-link px-2" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>
                            @if($cartCount)
                                <span class="badge bg-primary position-absolute top-0 start-100 translate-middle"
                                      style="font-size: 0.55rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- User --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-2"
                           data-bs-toggle="dropdown"
                           href="#">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle me-2"
                                 width="28" height="28"
                                 style="object-fit: cover">
                            <span class="d-none d-lg-inline small fw-medium">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-primary"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
