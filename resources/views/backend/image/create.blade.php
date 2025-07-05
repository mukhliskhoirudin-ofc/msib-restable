@extends('backend.layouts.main')

@section('title', 'Create')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.image.create') }}">Create</a>
                    </li>
                </ol>
                <div class="card">
                    <h5 class="card-header">Create Image</h5>
                    <div class="card-body">
                        <form action="{{ route('panel.image.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="John Doe"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file"
                                    name="file" id="file" accept="image/*" />
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="float-end ml-2">
                                <a href="{{ route('panel.image.index') }}">
                                    <div class="btn btn-secondary">Back</div>
                                </a>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
