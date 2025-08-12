<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BookingRequest;
use App\Mail\BookingMailPending;

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

            //send email
            Mail::to('owner@gmail.com')
                ->cc('operator@gmail.com')
                ->send(new BookingMailPending($validated)); //data $validated ini kirim ke BookingMailPending

            Transaction::create($validated);

            return redirect()->back()->with('success', 'Booking berhasil dikirim.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
