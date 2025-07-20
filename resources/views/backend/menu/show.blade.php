@extends('backend.layouts.main')

@section('title', 'Detail Menu')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 mb-4">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item fw-bold">Master Data</li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.menu.index') }}">Menu</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detail Menu : {{ $menu->name }}</h5>

                        <div class="row g-4 flex-column flex-md-row">
                            <!-- Gambar -->
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="border rounded shadow-sm p-2 bg-white w-100">
                                    <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid rounded w-100"
                                        style="object-fit: contain; max-height: 220px;">
                                </div>
                            </div>

                            <!-- Detail -->
                            <div class="col-12 col-md-8 col-lg-9">
                                <div class="row gy-3">
                                    <!-- Nama -->
                                    <div class="col-12 col-sm-6">
                                        <label class="fw-semibold text-muted small">Nama</label>
                                        <div class="text-break text-wrap fs-6">{{ $menu->name }}</div>
                                    </div>

                                    <!-- Kategori -->
                                    <div class="col-12 col-sm-6">
                                        <label class="fw-semibold text-muted small">Kategori</label>
                                        <div class="text-break text-wrap fs-6">{{ $menu->category->name ?? '-' }}</div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row gy-3">
                                    <!-- Harga -->
                                    <div class="col-12 col-sm-6">
                                        <label class="fw-semibold text-muted small">Harga</label>
                                        <div class="fs-6">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-12 col-sm-6">
                                        <label class="fw-semibold text-muted small">Status</label>
                                        <div class="fs-6">
                                            <span class="badge rounded-pill bg-{{ $menu->badge_color }}">
                                                {{ ucfirst($menu->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted small">Deskripsi</label>
                                    <div class="text-break text-wrap fs-6">{{ $menu->description }}</div>
                                </div>

                                <hr class="my-3">

                                <!-- Tombol Aksi -->
                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    <a href="{{ route('panel.menu.index') }}" class="btn btn-secondary">Kembali</a>
                                    <a href="{{ route('panel.menu.edit', $menu) }}" class="btn btn-warning">Edit</a>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
