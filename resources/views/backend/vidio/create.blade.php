@extends('backend.layouts.main')

@section('title', 'Tambah Vidio')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb --}}
        <ol class="breadcrumb fs-5 mb-4">
            <li class="breadcrumb-item">
                <div class="fw-bold cursor-pointer">Gallery</div>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('panel.vidio.index') }}">Vidio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('panel.vidio.create') }}">Create</a>
            </li>
        </ol>

        {{-- Card Form --}}
        <div class="card shadow-sm border-0">
            <h5 class="card-header">Create Vidio</h5>
            <div class="card-body">
                <form action="{{ route('panel.vidio.store') }}" method="POST">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Vidio</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                            placeholder="Masukkan judul vidio" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">URL YouTube</label>
                        <input type="url" id="url" name="url"
                            class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}"
                            placeholder="https://www.youtube.com/watch?v=xxxx" required>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('panel.vidio.index') }}" class="btn btn-light border">
                            <i class="bx bx-x me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
