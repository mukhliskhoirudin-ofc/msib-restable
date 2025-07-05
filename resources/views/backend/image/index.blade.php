@extends('backend.layouts.main')

@section('title', 'Image')

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
                </ol>
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-3 pt-3 pb-3">
                                    <h5 class="mb-0">Gallery</h5>
                                    <a href="{{ route('panel.image.create') }}"
                                        class="btn btn-md rounded-pill btn-primary px-4">
                                        Create
                                    </a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Description</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($images as $image)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $image->name }}</td>
                                                    <td>{{ $image->slug }}</td>
                                                    <td>{{ $image->description }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $image->file) }}" width="80">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-secondary">
                                                            <span class="tf-icons bx bx-show"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-icon btn-warning">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-icon btn-danger">
                                                            <span class="tf-icons bx bx-trash"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
