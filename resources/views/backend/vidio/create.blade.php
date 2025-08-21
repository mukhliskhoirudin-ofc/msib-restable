@extends('backend.layouts.main')

@section('title', 'Tambah Vidio')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bx bx-video me-1"></i> Tambah Vidio</h4>
            <a href="{{ route('panel.vidio.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back
            </a>
        </div>

        {{-- Card Form --}}
        <div class="card shadow-sm border-0">
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
