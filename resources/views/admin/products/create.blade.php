@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10"> {{-- Dipersempit agar lebih fokus --}}

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-1 fw-bold text-primary">
                    <i class="bi bi-plus-circle-dotted me-2"></i>Tambah Produk Baru
                </h2>
                <p class="text-muted small mb-0">Lengkapi formulir di bawah untuk menambahkan item ke katalog.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                {{-- KOLOM KIRI: INFO UTAMA --}}
                <div class="col-md-8">
                    {{-- BASIC INFO --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-card-text me-2 text-primary"></i>Informasi Umum</h6>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Contoh: Smart TV Samsung 43 Inch" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori...</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
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
                                            value="{{ old('weight') }}" min="1" placeholder="0" required>
                                        <span class="input-group-text">gr</span>
                                    </div>
                                    @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">Deskripsi Lengkap</label>
                                <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Jelaskan spesifikasi dan keunggulan produk...">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- HARGA & STOK --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-tag me-2 text-primary"></i>Harga & Inventaris</h6>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Harga Jual</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">Rp</span>
                                        <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}" placeholder="0" required>
                                    </div>
                                    @error('price') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Harga Diskon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-success">Rp</span>
                                        <input type="number" id="discount_price" name="discount_price" class="form-control @error('discount_price') is-invalid @enderror"
                                            value="{{ old('discount_price') }}" placeholder="Opsional">
                                    </div>
                                    <div id="discount-label" class="mt-1"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Stok Unit</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', 0) }}" min="0" required>
                                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: MEDIA & STATUS --}}
                <div class="col-md-4">
                    {{-- STATUS CARD --}}
                    <div class="card shadow-sm border-0 mb-4 text-center py-2">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 text-start"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded">
                                <label class="form-check-label fw-semibold mb-0">Aktifkan Produk</label>
                                <div class="form-check form-switch p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_active" value="1"
                                        style="width: 2.5em; height: 1.25em" {{ old('is_active', true) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                <label class="form-check-label fw-semibold mb-0">Produk Unggulan</label>
                                <div class="form-check form-switch p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_featured" value="1"
                                        style="width: 2.5em; height: 1.25em" {{ old('is_featured') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MEDIA CARD --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bi bi-images me-2 text-primary"></i>Media</h6>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto Produk</label>
                                <input type="file" name="images[]" id="imageInput" class="form-control @error('images') is-invalid @enderror"
                                    multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Dapat memilih lebih dari 1 gambar.</small>
                                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            {{-- Container Preview Gambar --}}
                            <div id="imagePreview" class="row g-2"></div>
                        </div>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="sticky-top" style="top: 20px; z-index: 1;">
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow">
                            <i class="bi bi-save me-1"></i> Simpan Produk
                        </button>
                        <p class="text-center text-muted small mt-2">Pastikan semua data sudah benar sebelum disimpan.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
