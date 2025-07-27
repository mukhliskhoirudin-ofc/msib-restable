@extends('backend.layouts.main')

@section('title', 'Edit Chef')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Master Data<div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.chef.index') }}">Chef</a>
                    </li>
                    <li class="breadcrumb-item cursor-pointer">
                        <span>Edit</span>
                    </li>
                </ol>
                <div class="card">
                    <h5 class="card-header">Edit chef</h5>
                    <div class="card-body">
                        <form action="{{ route('panel.chef.update', $chef) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $chef) }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="position">Position</label>
                                    <select name="position" class="form-select @error('position') is-invalid @enderror"
                                        id="">
                                        <option value="master chef" @selected(old('position', $chef->position) == 'master chef')>Master
                                            Chef
                                        </option>
                                        <option value="patissier" @selected(old('position', $chef->position) == 'patissier')>
                                            Patissier
                                        </option>
                                        <option value="cook" @selected(old('position', $chef->position) == 'cook')>
                                            Cook
                                        </option>
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="insta_link" class="form-label">Instagram</label>
                                    <input type="text" id="insta_link" name="insta_link" placeholder="https://"
                                        class="form-control @error('insta_link') is-invalid @enderror"
                                        value="{{ old('insta_link', $chef) }}">
                                    @error('insta_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="linked_link" class="form-label">LinkedIn</label>
                                    <input type="text" id="linked_link" name="linked_link" placeholder="https://"
                                        class="form-control @error('linked_link') is-invalid @enderror"
                                        value="{{ old('linked_link', $chef) }}">
                                    @error('linked_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    rows="3">{{ old('description', $chef) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">File</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image" id="file" accept="image/*" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <img src="{{ asset('storage/' . $chef->image) }}" alt="" id="file-preview"
                                    class="img-thumbnail" width="120">
                            </div>

                            <div class="float-end ml-2 mt-4">
                                <a href="{{ route('panel.chef.index') }}">
                                    <div class="btn btn-secondary">Back</div>
                                </a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/assets/js/image-preview.js') }}"></script>
@endpush
