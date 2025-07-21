@extends('backend.layouts.main')

@section('title', 'Edit Menu')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Master Data</div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.menu.index') }}">Menu</a>
                    </li>
                    <li class="breadcrumb-item cursor-pointer">
                        <span>Edit</span>
                    </li>
                </ol>

                <div class="card">
                    <h5 class="card-header">Edit Menu</h5>
                    <div class="card-body">
                        <form action="{{ route('panel.menu.update', $menu) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $menu->name) }}" placeholder="Nama menu">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                                class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', $menu->category_id) == $category->id)>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="price" id="price" min="0"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price', $menu->price) }}" placeholder="Contoh: 15000">
                                        </div>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <select name="status" id="status"
                                            class="form-select @error('status') is-invalid @enderror">
                                            <option value="active" @selected(old('status', $menu->status) == 'active')>Active
                                            </option>
                                            <option value="inactive" @selected(old('status', $menu->status) == 'inactive')>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="image" id="file"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        width="120" id="file-preview">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="3">{{ old('description', $menu->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="float-end">
                                <a href="{{ route('panel.menu.index') }}" class="btn btn-secondary">Back</a>
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
