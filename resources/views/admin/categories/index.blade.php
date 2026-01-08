@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
{{-- HEADER PAGE --}}
<div class="row mb-4">
    <div class="col-md-7">
        <h2 class="h3 fw-bold text-primary mb-1">
            <i class="bi bi-grid-fill me-2"></i>Manajemen Kategori
        </h2>
        <p class="text-muted small">Kelola kategori produk Anda untuk mempermudah navigasi pelanggan.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <div class="d-inline-flex gap-2">
            {{-- Badge Tanggal --}}
            <div class="badge bg-white text-dark border shadow-sm p-2 px-3 rounded-pill d-flex align-items-center">
                <i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d F Y') }}
            </div>

            {{-- Tombol Lihat Toko --}}
            <a href="/" target="_blank" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold d-flex align-items-center">
                <i class="bi bi-shop me-2 text-primary"></i> Lihat Toko
            </a>

            {{-- Tombol Keluar --}}
            <button type="button" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold text-danger d-flex align-items-center"
                onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar
            </button>
        </div>

        {{-- Form Logout (Penting) --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{-- Alert Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
                <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-list-ul me-2"></i>Daftar Kategori</h5>
                <button class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg me-1"></i> Kategori Baru
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Detail Kategori</th>
                                <th class="text-center">Total Produk</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            @if($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" class="rounded shadow-sm me-3 border" width="45" height="45" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center me-3 border" style="width: 45px; height: 45px;">
                                                    <i class="bi bi-tag text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $category->name }}</div>
                                                <small class="text-muted">slug: {{ $category->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-3 rounded-pill fw-normal">
                                            {{ $category->products_count ?? 0 }} Produk
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($category->is_active)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 rounded-pill">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 rounded-pill">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm rounded">
                                            <button class="btn btn-sm btn-white border-end" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}" title="Edit">
                                                <i class="bi bi-pencil-fill text-warning"></i>
                                            </button>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                                  class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-white" title="Hapus">
                                                    <i class="bi bi-trash-fill text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title fw-bold">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small text-muted">Nama Kategori</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold small text-muted">Ganti Gambar</label>
                                                        <input type="file" name="image" class="form-control" accept="image/*">
                                                    </div>
                                                    <div class="form-check form-switch mt-3">
                                                        <input type="hidden" name="is_active" value="0">
                                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="switch{{$category->id}}" {{ $category->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="switch{{$category->id}}">Status Aktif</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light border-top-0">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x display-4 d-block mb-3"></i>
                                        Belum ada kategori ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH (Create) --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Sepatu Olahraga">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Gambar Cover</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="switchCreate" checked>
                        <label class="form-check-label fw-bold" for="switchCreate">Aktifkan Sekarang</label>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- BANTUAN ADMIN --}}
<div class="card border-0 shadow-sm rounded-3 bg-primary-subtle mt-2">
    <div class="card-body p-3">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="bi bi-headset small"></i>
            </div>
            <p class="small text-dark-emphasis mb-0 ms-2">
                Butuh bantuan mengelola kategori? Hubungi <strong>Tokokamikami</strong> atau chat <a href="https://wa.me/6289619869600" class="text-decoration-none fw-bold">089619869600</a>.
            </p>
        </div>
    </div>
</div>
@endsection
