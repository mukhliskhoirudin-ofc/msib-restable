<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        $validated = $request->validated();

        $transaction = Transaction::where('code', $validated['code'])
            ->where('status', 'success')->first();

        // Periksa apakah transaksi ditemukan
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Periksa apakah transaksi sudah memiliki review
        if ($transaction->review()->exists()) {
            return redirect()->back()->with('error', 'Transaksi sudah memiliki review.');
        }

        // Simpan Review
        Review::create([
            'transaction_id' => $transaction->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->back()->with('success', 'Review berhasil dikirim.');
    }
}
