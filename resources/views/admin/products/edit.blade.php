@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-1 fw-bold text-warning">
                    <i class="bi bi-pencil-square me-2"></i>Edit Produk
                </h2>
                <p class="text-muted small mb-0">ID Produk: #{{ $product->id }} | Terakhir diperbarui: {{ $product->updated_at->format('d M Y') }}</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- KOLOM KIRI: INFO UTAMA --}}
                <div class="col-md-8">
                    {{-- BASIC INFO --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-card-text me-2 text-warning"></i>Informasi Umum</h6>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Berat (gram)</label>
                                    <div class="input-group">
                                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                            value="{{ old('weight', $product->weight) }}" required min="1">
                                        <span class="input-group-text">gr</span>
                                    </div>
                                    @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">Deskripsi Produk</label>
                                <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                   {{-- HARGA & STOK --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3"><i class="bi bi-cash-stack me-2 text-warning"></i>Harga & Stok</h6>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Harga Normal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">Rp</span>
                    {{-- Input mask menggunakan type text agar separator titik bisa muncul saat diketik --}}
                    <input type="text" id="price_display" class="form-control @error('price') is-invalid @enderror"
                        value="{{ number_format(old('price', $product->price), 0, ',', '.') }}" required>
                    {{-- Hidden input untuk mengirim angka murni ke database --}}
                    <input type="hidden" name="price" id="price" value="{{ old('price', $product->price) }}">
                </div>
                @error('price') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Harga Diskon (Opsional)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-success">Rp</span>
                    <input type="text" id="discount_display" class="form-control @error('discount_price') is-invalid @enderror"
                        value="{{ $product->discount_price ? number_format(old('discount_price', $product->discount_price), 0, ',', '.') : '' }}">
                    <input type="hidden" name="discount_price" id="discount_price" value="{{ old('discount_price', $product->discount_price) }}">
                </div>
                <div id="discount-info" class="mt-1 small"></div>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Stok Unit</label>
                <div class="input-group">
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', $product->stock) }}" required>
                    <span class="input-group-text">Unit</span>
                </div>
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceDisplay = document.getElementById('price_display');
        const priceInput = document.getElementById('price');
        const discountDisplay = document.getElementById('discount_display');
        const discountInput = document.getElementById('discount_price');
        const discountInfo = document.getElementById('discount-info');

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function handleInput(display, hidden) {
            display.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\./g, '');
                hidden.value = value;
                e.target.value = formatNumber(value);
                validatePrices();
            });
        }

        function validatePrices() {
            let p = parseInt(priceInput.value) || 0;
            let d = parseInt(discountInput.value) || 0;

            if (d > 0 && d >= p) {
                discountInfo.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-triangle"></i> Harga diskon harus lebih kecil dari harga normal!</span>`;
                discountDisplay.classList.add('is-invalid');
            } else if (d > 0 && d < p) {
                let hemat = p - d;
                let persen = Math.round((hemat / p) * 100);
                discountInfo.innerHTML = `<span class="text-success"><i class="bi bi-check-circle"></i> Hemat Rp ${formatNumber(hemat.toString())} (${persen}%)</span>`;
                discountDisplay.classList.remove('is-invalid');
            } else {
                discountInfo.innerHTML = "";
                discountDisplay.classList.remove('is-invalid');
            }
        }

        handleInput(priceDisplay, priceInput);
        handleInput(discountDisplay, discountInput);
    });
</script>

                    {{-- MEDIA (Gambar Lama) --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-images me-2 text-warning"></i>Kelola Gambar Saat Ini</h6>
                            <div class="row g-3">
                                @foreach($product->images as $image)
                                <div class="col-md-4 col-lg-3">
                                    <div class="card h-100 border shadow-sm rounded-3 overflow-hidden">
                                        <img src="{{ asset('storage/'.$image->image_path) }}" class="card-img-top" style="height: 120px; object-fit: cover;">
                                        <div class="card-body p-2 bg-light">
                                            <div class="form-check small mb-1">
                                                <input class="form-check-input" type="radio" name="primary_image" id="p-{{$image->id}}"
                                                    value="{{ $image->id }}" {{ $image->is_primary ? 'checked' : '' }}>
                                                <label class="form-check-label" for="p-{{$image->id}}">Utama</label>
                                            </div>
                                            <div class="form-check small">
                                                <input class="form-check-input" type="checkbox" name="delete_images[]" id="d-{{$image->id}}"
                                                    value="{{ $image->id }}">
                                                <label class="form-check-label text-danger" for="d-{{$image->id}}">Hapus</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: STATUS & UPLOAD BARU --}}
                <div class="col-md-4">
                    {{-- STATUS SETTINGS --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-gear me-2 text-warning"></i>Pengaturan Status</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded">
                                <label class="form-check-label fw-semibold mb-0">Status Aktif</label>
                                <div class="form-check form-switch p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_active" value="1"
                                        style="width: 2.5em; height: 1.25em" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                <label class="form-check-label fw-semibold mb-0">Produk Unggulan</label>
                                <div class="form-check form-switch p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_featured" value="1"
                                        style="width: 2.5em; height: 1.25em" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- NEW MEDIA UPLOAD --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-cloud-upload me-2 text-warning"></i>Tambah Gambar</h6>
                            <input type="file" name="images[]" id="imageInput" class="form-control mb-2" multiple accept="image/*">
                            <small class="text-muted d-block mb-3">JPG, PNG, WEBP (Maks 2MB).</small>
                            <div id="imagePreview" class="row g-2"></div>
                        </div>
                    </div>

                    {{-- UPDATE BUTTON --}}
                    <div class="sticky-top" style="top: 20px; z-index: 1;">
                        <button type="submit" class="btn btn-warning btn-lg w-100 shadow text-white fw-bold">
                            <i class="bi bi-save me-1"></i> Update Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
