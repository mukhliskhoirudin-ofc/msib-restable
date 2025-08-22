@extends('backend.layouts.main')

@section('title', 'Reviews')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Feedback</div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.review.index') }}">Reviews</a>
                    </li>
                </ol>
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                {{-- Alert Success & Error --}}
                                {{-- @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif --}}

                                <div class="d-flex justify-content-between align-items-center px-3 pt-3">
                                    <h5 class="mb-0">Customer Reviews</h5>
                                </div>

                                <div class="table-responsive text-nowrap mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                                <tr>
                                                    <td>{{ $reviews->firstItem() + $loop->index }}</td>
                                                    <td>{{ $review->transaction->code }}</td>
                                                    <td>{{ $review->transaction->name }}</td>
                                                    <td>{{ Str::ucfirst($review->transaction->type) }}</td>
                                                    <td>
                                                        <div class="rating-stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <span
                                                                    class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                    <td>{{ Str::limit($review->comment ?? '-', 35) }}</td>
                                                    <td>
                                                        <a href="{{ route('panel.review.show', $review) }}"
                                                            class="btn btn-icon btn-secondary">
                                                            <span class="tf-icons bx bx-show"></span>
                                                        </a>

                                                        <form id="delete-form-{{ $review->id }}"
                                                            action="{{ route('panel.review.destroy', $review) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-icon btn-danger"
                                                                onclick="confirmDelete('delete-form-{{ $review->id }}')">
                                                                <span class="tf-icons bx bx-trash"></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">
                                                        No reviews available.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    @if ($reviews->hasPages())
                                        <div class="mt-3">
                                            {{ $reviews->links() }}
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

@push('css')
    <style>
        .rating-stars {
            display: inline-flex;
        }

        .rating-stars .star {
            color: #ddd;
            font-size: 1.2rem;
        }

        .rating-stars .star.filled {
            color: #ffc107;
        }
    </style>
@endpush
