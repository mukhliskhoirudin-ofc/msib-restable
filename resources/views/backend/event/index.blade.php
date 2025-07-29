@extends('backend.layouts.main')

@section('title', 'Event')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Master Data</div>
                    </li>
                    <li class="breadcrumb-item cursor-pointer">
                        <span>Event</span>
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
                                    <h5 class="mb-0">Event</h5>
                                    <a href="{{ route('panel.event.create') }}"
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
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($events as $event)
                                                <tr>
                                                    <td>{{ $events->firstItem() + $loop->index }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                                                    <td>{{ Str::limit($event->description, 35) }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $event->image) }}" width="80">
                                                    </td>
                                                    <td>
                                                        {{-- ini badge via assesornya ada di model event --}}
                                                        <span class="badge rounded-pill bg-{{ $event->badge_color }}">
                                                            {{ $event->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('panel.event.edit', $event) }}"
                                                            class="btn btn-icon btn-warning">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                        <form action="{{ route('panel.event.destroy', $event) }}"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus event ini?')"
                                                            method="post">
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
                                                    <td colspan="8" class="text-center text-muted">Data event tidak
                                                        tersedia.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if ($events->hasPages())
                                        <div class="mt-3">
                                            {{ $events->links() }}
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
