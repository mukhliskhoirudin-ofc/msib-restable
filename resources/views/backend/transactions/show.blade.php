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
                                        {{ $transaction->date }}
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
                        <div class="mt-4">
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
                <i class="bx bx-chevron-left me-1"></i> Back
            </a>

            @if ($transaction->status === 'pending')
                <!-- Tombol untuk status Pending -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                    <i class="bx bx-check-circle me-1"></i> Approve
                </button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    <i class="bx bx-x-circle me-1"></i> Reject
                </button>

                <!-- Modal Approve -->
                <div class="modal fade" id="approveModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Approval</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to approve this transaction?</p>
                                <p><strong>ID:</strong> {{ $transaction->code }}</p>
                                <p><strong>Amount:</strong> Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        <i class="bx bx-check-circle me-1"></i> Confirm Approve
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Reject -->
                <div class="modal fade" id="rejectModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Rejection</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to reject this transaction?</p>
                                <div class="mb-3">
                                    <label for="rejectReason" class="form-label">Reason (optional)</label>
                                    <textarea class="form-control" id="rejectReason" name="reason" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="reason" id="modalRejectReason">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bx bx-x-circle me-1"></i> Confirm Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($transaction->status === 'success')
                <span class="btn btn-success disabled">
                    <i class="bx bx-check-circle me-1"></i> Approved
                </span>
            @elseif($transaction->status === 'failed')
                <span class="btn btn-danger disabled">
                    <i class="bx bx-x-circle me-1"></i> Rejected
                </span>
            @endif
        </div>

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

        // Untuk mengisi reason dari textarea ke input hidden
        document.getElementById('rejectModal').addEventListener('show.bs.modal', function() {
            document.getElementById('modalRejectReason').value = document.getElementById('rejectReason').value;
        });

        document.getElementById('rejectReason').addEventListener('input', function() {
            document.getElementById('modalRejectReason').value = this.value;
        });
    </script>
@endpush
