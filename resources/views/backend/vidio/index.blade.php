@extends('backend.layouts.main')

@section('title', 'Vidio')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                {{-- Breadcrumb --}}
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Gallery</div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.vidio.index') }}">Vidio</a>
                    </li>
                </ol>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Daftar Vidio</h5>
                    <a href="{{ route('panel.vidio.create') }}" class="btn btn-md rounded-pill btn-primary px-4">
                        <i class="bx bx-plus me-1"></i> Create
                    </a>
                </div>

                {{-- Grid List --}}
                <div class="row g-4">
                    @forelse ($vidios as $vidio)
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                @if ($vidio->thumbnail_url)
                                    <img src="{{ $vidio->thumbnail_url }}" class="card-img-top" alt="thumbnail"
                                        style="cursor: pointer;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="height:180px;">
                                        <span class="text-muted">No Thumbnail</span>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-semibold mb-3">{{ Str::limit($vidio->title, 60, '...') }}</h6>
                                    {{-- url --}}
                                    <p class="card-text mb-3">
                                        <i class="bx bx-link"></i>
                                        <a href="{{ $vidio->url }}" target="_blank" class="text-decoration-none">
                                            {{ Str::limit($vidio->url, 30, '...') }}
                                        </a>
                                    </p>
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="{{ route('panel.vidio.show', $vidio) }}"
                                            class="btn btn-secondary px-2 py-1" title="Lihat">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('panel.vidio.edit', $vidio) }}" class="btn btn-warning px-2 py-1"
                                            title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('panel.vidio.destroy', $vidio) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus vidio ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger px-2 py-1" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No vidios available.
                            </td>
                        </tr>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if ($vidios->hasPages())
                    <div class="mt-4">
                        {{ $vidios->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
