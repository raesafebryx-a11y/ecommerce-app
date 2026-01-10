@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 1. BACKGROUND DINAMIS */
    body.login-bg {
        min-height: 100vh;
        /* Menggunakan warna yang senada dengan tema Beranda Premium */
        background: radial-gradient(circle at 0% 0%, #0f172a 0%, #020617 100%);
        background-attachment: fixed;
        display: flex;
        flex-direction: column;
    }

    /* Efek Grid Halus di Background */
    body.login-bg::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: linear-gradient(rgba(251, 191, 36, 0.03) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(251, 191, 36, 0.03) 1px, transparent 1px);
        background-size: 30px 30px;
        z-index: -1;
    }

    /* 2. GLASSMORPHISM CARD */
    .login-glass {
        background: rgba(255, 255, 255, 0.04);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        color: white;
    }

    /* 3. INPUT STYLING */
    .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white !important;
        border-radius: 12px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #fbbf24;
        box-shadow: 0 0 0 0.25rem rgba(251, 191, 36, 0.15);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-label {
        color: #fbbf24;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    /* 4. BUTTONS */
    .login-btn {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border: none;
        color: #020617;
        font-weight: 700;
        border-radius: 12px;
        padding: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .login-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
        background: #fbbf24;
        color: #020617;
    }

    .btn-google-login {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-google-login:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #fbbf24;
        color: white;
    }

    /* 5. ILLUSTRATION SHADOW */
    .img-glow {
        filter: drop-shadow(0 0 20px rgba(37, 99, 235, 0.3));
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .login-link {
        color: #fbbf24;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .login-link:hover {
        color: #fff;
        text-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
    }
</style>

<script>
    document.body.classList.add('login-bg');
</script>

<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center animate__animated animate__fadeInLeft">
            <div class="text-center">
                <img src="https://www.svgrepo.com/show/424993/security.svg" alt="Security Illustration"
                    class="img-fluid w-75 img-glow mb-4">
                <h2 class="text-white fw-bold">Keamanan Prioritas Kami</h2>
                <p class="text-white-50 fs-5">Lindungi privasi dan transaksi Anda di Tokokamikami Premium.</p>
            </div>
        </div>

        <div class="col-lg-5 col-md-8 animate__animated animate__fadeInRight">
            <div class="login-glass p-4 p-md-5">
                <div class="text-center mb-5">
                    <h3 class="fw-bold mb-1 text-gold-gradient" style="background: linear-gradient(90deg, #fff 0%, #fbbf24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Welcome Back!
                    </h3>
                    <p class="text-white-50 small">Gunakan akun Tokokamikami Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">EMAIL ADDRESS</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="nama@email.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label">PASSWORD</label>
                            @if (Route::has('password.request'))
                                <a class="login-link small fw-normal" href="{{ route('password.request') }}">Lupa?</a>
                            @endif
                        </div>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="••••••••" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-white-50 small" for="remember">
                            Biarkan saya tetap masuk
                        </label>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn login-btn">
                            Sign In Account
                        </button>
                    </div>

                    <div class="position-relative my-4 text-center">
                        <hr style="border-color: rgba(255,255,255,0.1)"/>
                        <span class="position-absolute top-50 start-50 translate-middle px-3 text-white-50 small" style="background: #020617;">
                            atau login via
                        </span>
                    </div>

                   <div class="d-grid mb-4">
    <a href="{{ route('auth.google') }}" class="btn btn-google-login d-flex align-items-center justify-content-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
        </svg>
        <span>Continue with Google</span>
    </a>
</div>

<style>
    /* Tambahan style agar tombol Google lebih 'mahal' dilihat */
    .btn-google-login {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-google-login:hover {
        background: white;
        color: #020617;
        border-color: white;
        transform: translateY(-2px);
    }

    .btn-google-login svg {
        transition: transform 0.3s ease;
    }

    .btn-google-login:hover svg {
        transform: scale(1.1);
    }
</style>

                    <p class="text-center mb-0 text-white-50 small">
                        Belum terdaftar?
                        <a href="{{ route('register') }}" class="login-link">
                            Buka Akun Gratis
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
