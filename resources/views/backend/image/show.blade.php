@extends('backend.layouts.main')

@section('title', 'Detail Image')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Gallery</div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.image.index') }}">Image</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detail Gambar</h5>

                        <div class="d-flex flex-column flex-md-row align-items-start gap-5">
                            <!-- Gambar di kiri -->
                            <div class="flex-shrink-0" style="max-width: 240px; width: 100%;">
                                <div class="border rounded shadow-sm p-2 bg-white">
                                    <img src="{{ asset('storage/' . $image->file) }}" class="img-fluid rounded w-100"
                                        style="object-fit: contain; max-height: 220px;">
                                </div>
                            </div>

                            <!-- Detail teks di kanan -->
                            <div class="flex-grow-1">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Nama</label>
                                        <div class="fs-6">{{ $image->name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Slug</label>
                                        <div class="fs-6">{{ $image->slug }}</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Dibuat Pada</label>
                                        <div class="fs-6">{{ $image->created_at->translatedFormat('d F Y, H:i') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Diperbarui Pada</label>
                                        <div class="fs-6">{{ $image->updated_at->translatedFormat('d F Y, H:i') }}</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="fw-semibold text-muted">Deskripsi</label>
                                    <div class="fs-6">{{ $image->description }}</div>
                                </div>

                                <div class="mt-4 d-flex flex-wrap gap-2">
                                    <a href="{{ route('panel.image.index') }}" class="btn btn-secondary">Kembali</a>
                                    <a href="{{ route('panel.image.edit', $image) }}" class="btn btn-warning">Edit</a>
                                </div>
                            </div>
                        </div> <!-- end flex row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
