@extends('backend.layouts.main')

@section('title', 'Menu')

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
                </ol>
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                {{-- Alert Success & Error --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Berhasil!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Tutup"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Gagal!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Tutup"></button>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center px-3 pt-3 pb-3">
                                    <h5 class="mb-0">Menu</h5>
                                    <a href="#" class="btn btn-md rounded-pill btn-primary px-4">
                                        Create
                                    </a>
                                </div>

                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($menus as $menu)
                                                <tr>
                                                    <td>{{ $menus->firstItem() + $loop->index }}</td>
                                                    <td>{{ $menu->name }}</td>
                                                    <td>{{ $menu->category->name }}</td>
                                                    <td>{{ Str::limit($menu->description, 35) }}</td>
                                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $menu->image) }}" width="80">
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $menu->status == 'active' ? 'success' : 'secondary' }}">
                                                            {{ ucfirst($menu->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-icon btn-secondary">
                                                            <span class="tf-icons bx bx-show"></span>
                                                        </a>
                                                        <a href="#" class="btn btn-icon btn-warning">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                        <form action="#" method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-icon btn-danger">
                                                                <span class="tf-icons bx bx-trash"></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">Data menu tidak
                                                        tersedia.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if ($menus->hasPages())
                                        <div class="mt-3">
                                            {{ $menus->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
