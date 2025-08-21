@extends('backend.layouts.main')

@section('title', 'Dashboard Transaksi')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Welcome Card -->
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h2 class="card-title text-primary">
                                    Welcome Back - {{ auth()->user()->name }} 🎉
                                </h2>
                                <p class="mb-4">
                                    Selamat datang di halaman dashboard transaksi. Anda dapat melihat total transaksi,
                                    transaksi hari ini, dan transaksi yang belum dibayar. 📈
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('backend/assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row">
            <!-- Total Semua Transaksi -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-primary text-white me-3"
                            style="width: 60px; height: 60px; border-radius: 15%">
                            <i class="bx bx-receipt bx-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Semua Transaksi</small>
                            <h3 class="fw-bold mb-0">{{ !empty($totalTransactions) ? $totalTransactions : '-' }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Masuk Hari Ini -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-info text-white me-3"
                            style="width: 60px; height: 60px; border-radius: 15%">
                            <i class="bx bx-calendar bx-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted">Transaksi Masuk Hari Ini</small>
                            <h3 class="fw-bold mb-0">{{ !empty($todayTransactions) ? $todayTransactions : '-' }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Sukses -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-success text-white me-3"
                            style="width: 60px; height: 60px; border-radius: 15%">
                            <i class="bx bx-check-circle bx-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted">Transaksi Sukses</small>
                            <h3 class="fw-bold mb-0">{{ !empty($successTransactions) ? $successTransactions : '-' }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Pending -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-warning text-white me-3"
                            style="width: 60px; height: 60px; border-radius: 15%">
                            <i class="bx bx-time bx-lg"></i>
                        </div>
                        <div>
                            <small class="text-muted">Transaksi Pending</small>
                            <h3 class="fw-bold mb-0">{{ !empty($pendingTransactions) ? $pendingTransactions : '-' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi Terbaru -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="mb-0">
                    <i class="bx bx-receipt me-2 text-primary"></i> Transaksi Terbaru
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentTransactions as $trx)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold text-primary">
                                    #{{ $trx->code }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2 bg-light rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:36px; height:36px;">
                                            <i class="bx bx-user text-muted"></i>
                                        </div>
                                        <span>{{ $trx->name }}</span>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $trx->badge_color }}">
                                        {{ ucfirst($trx->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bx bx-info-circle me-1"></i> Belum ada transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
