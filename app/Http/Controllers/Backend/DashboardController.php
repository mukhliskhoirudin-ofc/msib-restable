<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index', [
            'totalTransactions'   => Transaction::count(),
            'todayTransactions' => Transaction::whereDate('created_at', today())->count(),
            'successTransactions' => Transaction::where('status', 'success')->count(),
            'pendingTransactions' => Transaction::where('status', 'pending')->count(),
            'failedTransactions'  => Transaction::where('status', 'failed')->count(),
            'recentTransactions'  => Transaction::latest()->take(5)->get(),
        ]);
    }
}
