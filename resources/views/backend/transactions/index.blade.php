@extends('backend.layouts.main')

@section('title', 'Transactions')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <ol class="breadcrumb fs-5 mb-4">
                    <li class="breadcrumb-item">
                        <div class="fw-bold cursor-pointer">Master Data</div>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('panel.transaction.index') }}">Transactions</a>
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
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Gagal!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center px-3 pt-3 pb-4">
                                    <h5 class="mb-0">Transactions</h5>
                                </div>

                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>People</th>
                                                <th>Amount</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>File</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transactions->firstItem() + $loop->index }}</td>
                                                    <td>{{ $transaction->name }}</td>
                                                    <td>{{ $transaction->type }}</td>
                                                    <td>{{ $transaction->people }}</td>
                                                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                                    <td>{{ $transaction->time }}</td>
                                                    <td>{{ $transaction->date }}</td>
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill bg-{{ $transaction->badge_color }}">
                                                            {{ $transaction->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($transaction->file)
                                                            <a href="{{ asset('storage/' . $transaction->file) }}"
                                                                target="_blank">View Payment</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ Str::limit($transaction->message, 30) }}</td>
                                                    <td>
                                                        <a href="{{ route('panel.transaction.show', $transaction) }}"
                                                            class="btn btn-icon btn-secondary">
                                                            <span class="tf-icons bx bx-show"></span>
                                                        </a>
                                                        <a href="{{ route('panel.transaction.edit', $transaction) }}"
                                                            class="btn btn-icon btn-warning">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                        <form
                                                            action="{{ route('panel.transaction.destroy', $transaction) }}"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
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
                                                    <td colspan="13" class="text-center text-muted">Data transaksi tidak
                                                        tersedia.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if ($transactions->hasPages())
                                        <div class="mt-3">
                                            {{ $transactions->links() }}
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
