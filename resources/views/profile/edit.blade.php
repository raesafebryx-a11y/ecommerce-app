{{-- resources/views/profile/edit.blade.php --}}

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 1. BACKGROUND & LAYOUT CONSISTENCY */
    body { background-color: #f8fafc; }

    /* Navigasi Atas (Sama dengan Katalog/Cart) */
    .catalog-nav {
        background: white;
        border-radius: 20px;
        padding: 15px 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    .btn-nav-back {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #020617;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 100px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-nav-back:hover {
        background: #f8fafc;
        border-color: #fbbf24;
        color: #fbbf24;
        transform: translateX(-5px);
    }

    /* 2. PROFILE CARD STYLING */
    .profile-card {
        border: none;
        border-radius: 25px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        margin-bottom: 25px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .card-header-premium {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-header-premium i {
        color: #fbbf24;
        font-size: 1.2rem;
    }

    .header-title {
        font-weight: 800;
        color: #020617;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        margin-bottom: 0;
    }

    /* 3. DANGER ZONE */
    .border-danger-premium {
        border: 1px solid #fee2e2 !important;
    }

    .header-danger {
        background: #fef2f2;
        color: #dc2626;
        padding: 20px 25px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    /* 4. ALERTS */
    .alert-premium {
        border-radius: 15px;
        border: none;
        background: #ecfdf5;
        color: #065f46;
        font-weight: 600;
    }
</style>

<div class="container py-4">

    {{-- TOP NAVIGATION (Konsisten dengan Katalog) --}}
    <div class="catalog-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="btn-nav-back shadow-sm">
                <i class="bi bi-house-door-fill"></i> Lihat Toko
            </a>
            <div class="vr d-none d-md-block" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark">Pengaturan Profil</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark rounded-pill px-3 py-2 border shadow-sm">
                <i class="bi bi-person-check-fill text-warning me-1"></i> {{ auth()->user()->name }}
            </span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11 animate__animated animate__fadeIn">

            @if (session('success'))
                <div class="alert alert-premium alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    {{-- 1. Avatar Information --}}
                    <div class="profile-card text-center py-4 px-3">
                        <div class="card-body">
                            @include('profile.partials.update-avatar-form')
                        </div>
                    </div>

                    {{-- 4. Connected Accounts --}}
                    <div class="profile-card">
                        <div class="card-header-premium">
                            <i class="bi bi-link-45deg"></i>
                            <h6 class="header-title">Koneksi</h6>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.connected-accounts')
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    {{-- 2. Profile Information --}}
                    <div class="profile-card">
                        <div class="card-header-premium">
                            <i class="bi bi-person-lines-fill"></i>
                            <h6 class="header-title">Informasi Pribadi</h6>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- 3. Update Password --}}
                    <div class="profile-card">
                        <div class="card-header-premium">
                            <i class="bi bi-shield-lock-fill"></i>
                            <h6 class="header-title">Keamanan Sandi</h6>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- 5. Delete Account --}}
                    <div class="profile-card border-danger-premium shadow-none opacity-75">
                        <div class="header-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Zona Bahaya
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
