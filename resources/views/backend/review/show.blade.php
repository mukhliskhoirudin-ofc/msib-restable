@extends('backend.layouts.main')

@section('title', 'Review Detail')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header Breadcrumb -->
        <ol class="breadcrumb fs-5 mb-4">
            <li class="breadcrumb-item">
                <div class="fw-bold cursor-pointer">Master Data</div>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('panel.review.index') }}">Reviews</a>
            </li>
            <li class="breadcrumb-item cursor-pointer">
                <span>Detail</span>
            </li>
        </ol>

        <!-- Main Card -->
        <div class="card mb-4 pt-2">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">Review #<b>{{ $review->transaction->code }}</b></h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">Rating: </span>
                    <span class="badge rounded-pill bg-warning px-3 py-2">
                        {{ $review->rating }}/5
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column - Review Details -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar avatar-lg me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-star"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">Customer Review</h6>
                                <small class="text-muted">Transaction #{{ $review->transaction->code }}</small>
                            </div>
                        </div>

                        <!-- Rating Display -->
                        <div class="border rounded p-3 mb-4">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Rating</small>
                                    <div class="d-flex align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="bx bxs-star text-warning fs-4"></i>
                                            @else
                                                <i class="bx bx-star text-warning fs-4"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-2 fw-semibold">{{ $review->rating }}/5</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Created</small>
                                    <h6 class="mb-0">
                                        {{ $review->created_at->timezone('Asia/Jakarta')->format('d/m/Y, H:i') }} WIB
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Section -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3">
                                <i class="bx bx-message-alt text-primary me-2"></i>
                                Customer Comment
                            </h6>
                            <div class="border rounded p-3 bg-light">
                                @if ($review->comment)
                                    <p class="mb-0">{{ $review->comment }}</p>
                                @else
                                    <span class="text-muted">No comment provided</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Transaction Details -->
                    <div class="col-md-6">
                        <h6 class="d-flex align-items-center mb-3">
                            <i class="bx bx-receipt text-primary me-2"></i>
                            Transaction Details
                        </h6>

                        <div class="border rounded p-4">
                            <div class="row mb-3 mt-1">
                                <div class="col-6">
                                    <small class="text-muted d-block">Transaction ID</small>
                                    <h6 class="mb-0">#{{ $review->transaction->code }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Type</small>
                                    <h6 class="mb-0">
                                        <span>{{ ucfirst($review->transaction->type) }}</span>
                                    </h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Customer Name</small>
                                    <h6 class="mb-0">{{ $review->transaction->name }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Email</small>
                                    <h6 class="mb-0">
                                        {{ $review->transaction->email }}
                                    </h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Phone</small>
                                    <h6 class="mb-0">
                                        {{ $review->transaction->phone }}
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">People</small>
                                    <h6 class="mb-0">{{ $review->transaction->people }} person(s)</h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Date & Time</small>
                                    <h6 class="mb-0">
                                        {{ \Carbon\Carbon::parse($review->transaction->date)->format('d/m/Y') }}
                                        at {{ $review->transaction->time }}
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Amount</small>
                                    <h6 class="mb-0 text-success">
                                        Rp. {{ number_format($review->transaction->amount, 2) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('panel.review.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-chevron-left me-1"></i> Back to List
            </a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .border {
            border-color: #d9dee3 !important;
        }
    </style>
@endpush
