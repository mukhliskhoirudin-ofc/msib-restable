<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Transaction;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('transactions', 'public');
            }

            if ($request->type == 'event') {
                $validated['amount'] = 100000;
            } else {
                $validated['amount'] = 50000;
            }

            Transaction::create($validated);

            return 'success';
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
