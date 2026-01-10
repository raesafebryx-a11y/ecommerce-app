<style>
    .avatar-wrapper {
        position: relative;
        display: inline-block;
        padding: 5px;
        background: linear-gradient(45deg, #fbbf24, #fff);
        border-radius: 50%;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .avatar-main {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        background: white;
    }

    .btn-delete-avatar {
        background: #dc2626;
        color: white;
        border: 2px solid white;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-delete-avatar:hover {
        background: #991b1b;
        transform: scale(1.1);
        color: white;
    }

    .custom-file-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        display: block;
        margin-bottom: 8px;
    }

    .premium-file-input {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
    }

    .btn-premium-save-sm {
        background: #020617;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    .btn-premium-save-sm:hover {
        background: #fbbf24;
        color: #020617;
        transform: translateY(-2px);
    }
</style>

<div class="mb-4">
    <p class="text-muted small">Upload foto profil terbaik Anda. Format: <strong>JPG, PNG, WebP</strong> (Maks. 2MB).</p>
</div>

<form method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="d-flex flex-column flex-md-row align-items-center gap-4">
        {{-- Avatar Preview dengan Bingkai Gold --}}
        <div class="avatar-wrapper animate__animated animate__zoomIn">
            <img id="avatar-preview" class="avatar-main"
                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                alt="{{ $user->name }}">

            @if($user->avatar)
            <button type="button"
                onclick="if(confirm('Hapus foto profil?')) document.getElementById('delete-avatar-form').submit()"
                class="btn btn-delete-avatar rounded-circle position-absolute top-0 start-100 translate-middle shadow"
                title="Hapus foto">
                <i class="bi bi-x-lg"></i>
            </button>
            @endif
        </div>

        {{-- Upload Input --}}
        <div class="flex-grow-1 w-100">
            <label class="custom-file-label"><i class="bi bi-camera me-2"></i>Pilih File Foto</label>
            <input type="file" name="avatar" id="avatar" accept="image/*" onchange="previewAvatar(event)"
                class="form-control premium-file-input @error('avatar') is-invalid @enderror">
            @error('avatar')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="mt-3">
                <button type="submit" class="btn btn-premium-save-sm shadow-sm">
                    <i class="bi bi-cloud-arrow-up me-2"></i>Simpan Foto
                </button>
            </div>
        </div>
    </div>
</form>

{{-- Hidden Form Delete Avatar --}}
<form id="delete-avatar-form" action="{{ route('profile.avatar.destroy') }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview');
                preview.src = e.target.result;
                preview.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => preview.classList.remove('animate__pulse'), 1000);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
