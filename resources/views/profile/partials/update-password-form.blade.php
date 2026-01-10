<style>
    /* Styling khusus input agar serasi dengan tema premium */
    .premium-form-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .premium-input {
        border-radius: 12px !important;
        padding: 12px 16px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        transition: all 0.3s ease !important;
        font-weight: 500;
    }

    .premium-input:focus {
        background-color: #fff !important;
        border-color: #fbbf24 !important;
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.1) !important;
        transform: translateY(-1px);
    }

    .btn-premium-save {
        background: #020617;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-premium-save:hover {
        background: #fbbf24;
        color: #020617;
        box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.3);
        transform: translateY(-2px);
    }
</style>

<div class="mb-4">
    <p class="text-muted small">Perbarui informasi profil dan alamat pengiriman Anda untuk pengalaman belanja yang lebih baik.</p>
</div>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-2">
    @csrf
    @method('patch')

    {{-- Nama --}}
    <div class="mb-4">
        <label for="name" class="premium-form-label"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
        <input type="text" name="name" id="name" class="form-control premium-input @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-4">
        <label for="email" class="premium-form-label"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
        <input type="email" name="email" id="email" class="form-control premium-input @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="nama@email.com">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Email Verification Notice --}}
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-3 p-3 rounded-4 bg-warning bg-opacity-10 border border-warning border-opacity-25">
            <p class="text-dark small mb-0">
                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Email Anda belum diverifikasi.
                <button form="send-verification" class="btn btn-link p-0 align-baseline text-decoration-none fw-bold text-warning">
                    Klik di sini untuk kirim ulang.
                </button>
            </p>
            @if (session('status') === 'verification-link-sent')
            <p class="text-success small fw-bold mt-2 mb-0">
                <i class="bi bi-check-circle-fill me-1"></i> Link verifikasi baru telah dikirim.
            </p>
            @endif
        </div>
        @endif
    </div>

    {{-- Phone --}}
    <div class="mb-4">
        <label for="phone" class="premium-form-label"><i class="bi bi-phone me-2"></i>Nomor Telepon</label>
        <input type="tel" name="phone" id="phone" class="form-control premium-input @error('phone') is-invalid @enderror"
            value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
        @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text text-muted small mt-2">Gunakan format yang valid untuk koordinasi pengiriman.</div>
    </div>

    {{-- Address --}}
    <div class="mb-4">
        <label for="address" class="premium-form-label"><i class="bi bi-geo-alt me-2"></i>Alamat Pengiriman</label>
        <textarea name="address" id="address" rows="3" class="form-control premium-input @error('address') is-invalid @enderror"
            placeholder="Tulis alamat lengkap Anda (Jalan, No Rumah, RT/RW, Kec, Kota)">{{ old('address', $user->address) }}</textarea>
        @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-3 pt-2">
        <button type="submit" class="btn btn-premium-save px-5 shadow-sm">
            <i class="bi bi-save me-2"></i>Simpan Perubahan
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small fw-bold animate__animated animate__fadeIn">
                <i class="bi bi-check-lg me-1"></i>Berhasil disimpan.
            </span>
        @endif
    </div>
</form>
