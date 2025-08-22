@extends('backend.layouts.main')

@section('title', 'Transaction Detail')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y t">
        <!-- Header -->
        <ol class="breadcrumb fs-5 mb-4">
            <li class="breadcrumb-item">
                <div class="fw-bold cursor-pointer">Master Data</div>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('panel.transaction.index') }}">Transactions</a>
            </li>
            <li class="breadcrumb-item cursor-pointer">
                <span>Detail</span>
            </li>
        </ol>

        <!-- Main Card -->
        <div class="card mb-4 pt-2">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">Transaction # <b>{{ $transaction->code }}</b></h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">Status: </span>
                    <span class="badge rounded-pill bg-{{ $transaction->badge_color }} px-3 py-2">
                        {{ $transaction->status }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column - Transaction Details -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar avatar-lg me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-receipt"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 text">{{ $transaction->name }}</h6>
                                <small class="text-muted">{{ $transaction->type }}</small>
                            </div>
                        </div>

                        <div class="border rounded p-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Email</small>
                                    <h6 class="mb-0">{{ $transaction->email }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Phone</small>
                                    <h6 class="mb-0">{{ $transaction->phone }}</h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Amount</small>
                                    <h6 class="mb-0">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">People</small>
                                    <h6 class="mb-0">{{ $transaction->people }}</h6>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Date</small>
                                    <h6 class="mb-0">
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Time</small>
                                    <h6 class="mb-0">{{ $transaction->time }}</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted d-block">Created</small>
                                    <h6 class="mb-0">
                                        {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y, H:i') }} WIB
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Last Update</small>
                                    <h6 class="mb-0">
                                        {{ $transaction->updated_at->timezone('Asia/Jakarta')->format('d/m/Y, H:i') }} WIB
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <!-- Message Section -->
                        <div class="mt-4 mb-4">
                            <h6 class="d-flex align-items-center mb-2">
                                <i class="bx bx-message-alt text-primary me-2"></i>
                                Message
                            </h6>
                            <div class="border rounded p-3 bg-light">
                                @if ($transaction->message)
                                    {{ $transaction->message }}
                                @else
                                    <span class="text-muted">No message provided</span>
                                @endif
                            </div>
                        </div>

                        @if ($transaction->status === 'failed')
                            <div class="text-bold fst-italic">Failed Reason : <span class="text-danger">
                                    {{ $transaction->reason }}
                                </span>
                            </div>
                        @endif
                    </div>


                    <!-- Right Column - Payment Proof & Message -->
                    <div class="col-md-6">
                        <!-- Payment Proof Section -->
                        <div class="mb-3">
                            <h6 class="d-flex align-items-center mb-3">
                                <i class="bx bx-image-alt text-primary me-2"></i>
                                Payment Proof
                            </h6>

                            @if ($transaction->file)
                                <div class="border rounded overflow-hidden d-flex align-items-center justify-content-center"
                                    style="height: 334px; background-color: #f8f9fa;">
                                    <div class="w-100 border rounded bg-light p-2 mb-3">
                                        <img src="{{ asset('storage/' . $transaction->file) }}" alt="Payment Proof"
                                            class="img-fluid w-100"
                                            style="max-height: 500px; object-fit: contain; display: block;">
                                    </div>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="{{ asset('storage/' . $transaction->file) }}" target="_blank"
                                        class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="bx bx-zoom-in me-1"></i> View Full Image
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 ms-2"
                                        onclick="downloadImage('{{ asset('storage/' . $transaction->file) }}')">
                                        <i class="bx bx-download me-1"></i> Download
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-light border d-flex align-items-center mb-0">
                                    <i class="bx bx-image-alt text-muted me-2"></i>
                                    No payment proof uploaded
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('panel.transaction.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-chevron-left me-1"></i> Back to List
            </a>

            @if ($transaction->status === 'pending')
                <!-- Tombol untuk status pending -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmPaymentModal">
                    <i class="bx bx-check-circle me-1"></i> Confirm Payment
                </button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectPaymentModal">
                    <i class="bx bx-x-circle me-1"></i> Reject Payment
                </button>
            @elseif($transaction->status === 'success')
                <!-- Tampilan untuk status success -->
                <span class="btn btn-success disabled">
                    <i class="bx bx-check-circle me-1"></i> Payment Confirmed
                </span>
            @elseif($transaction->status === 'failed')
                <!-- Tampilan untuk status failed -->
                <span class="btn btn-danger disabled">
                    <i class="bx bx-x-circle me-1"></i> Payment Rejected
                </span>
            @endif
        </div>

        <!-- Modal Confirm Payment -->
        @include('backend.transactions._modal-confirm')

        <!-- Modal Reject Payment -->
        @include('backend.transactions._modal-reject')

    </div>
@endsection

@push('js')
    <script>
        function downloadImage(url) {
            const link = document.createElement('a');
            link.href = url;
            link.download = 'payment-proof-' + new Date().getTime();
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Update hidden input with textarea value
        const textarea = document.getElementById('rejectionReason');
        const hiddenInput = document.getElementById('modalRejectionReason');

        if (textarea && hiddenInput) {
            textarea.addEventListener('input', function() {
                hiddenInput.value = this.value;
            });
        }
    </script>
@endpush
