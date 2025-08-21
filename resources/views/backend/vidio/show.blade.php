@extends('backend.layouts.main')

@section('title', 'Detail Vidio')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y d-flex justify-content-start">

        <div class="card shadow-sm border-0 rounded-3 w-100" style="max-width: 800px;">
            {{-- Video Player --}}
            @if ($vidio->embed_url)
                <div class="ratio ratio-16x9 rounded-top">
                    <iframe src="{{ $vidio->embed_url }}" frameborder="0" allowfullscreen class="rounded-top"></iframe>
                </div>
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded-top" style="height:400px;">
                    <span class="text-muted">Video tidak tersedia</span>
                </div>
            @endif

            <div class="card-body">
                <h4 class="fw-bold mb-3">{{ $vidio->title }}</h4>

                <p class="text-muted mb-4">
                    <i class="bx bx-link"></i>
                    <a href="{{ $vidio->url }}" target="_blank">{{ $vidio->url }}</a>
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('panel.vidio.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                    <a href="{{ route('panel.vidio.edit', $vidio) }}" class="btn btn-warning">
                        <i class="bx bx-edit"></i> Edit
                    </a>
                    <form action="{{ route('panel.vidio.destroy', $vidio) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus vidio ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bx bx-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
