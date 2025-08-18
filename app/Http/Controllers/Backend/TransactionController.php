<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\BookingMailFailed;
use Illuminate\Validation\Rule;
use App\Mail\BookingMailConfirm;
use App\Mail\BookingMailPending;
use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');
        $status = request()->input('status');
        $startDate = request()->input('start_date');
        $endDate = request()->input('end_date');

        $transaction = Transaction::query()
            ->latest()
            ->select([
                'code',
                'type',
                'name',
                'email',
                'phone',
                'date',
                'time',
                'people',
                'amount',
                'file',
                'status',
                'message',
                'created_at'
            ]);

        if ($search) {
            $transaction->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $transaction->where('status', $status);
        }

        if ($startDate && $endDate) {
            $transaction->whereBetween('date', [$startDate, $endDate]);
        }

        return view('backend.transactions.index', [
            'transactions' => $transaction->paginate(5)->withQueryString(),
            'search' => $search,
            'status' => $status,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('backend.transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['success', 'failed', 'pending'])],
            'reason' => ['nullable', 'string', 'max:255']
        ]);

        $transaction->update($validated);

        //send email
        if ($transaction->status === 'success') {
            Mail::to($transaction->email)
                ->cc('operator@gmail.com')
                ->send(new BookingMailConfirm($transaction));
        }

        if ($transaction->status === 'failed') {
            Mail::to($transaction->email)
                ->cc('operator@gmail.com')
                ->send(new BookingMailFailed($transaction));
        }

        return redirect()->route('panel.transaction.index')
            ->with('success', 'Transaction status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            if ($transaction->file && Storage::disk('public')->exists($transaction->file)) {
                Storage::disk('public')->delete($transaction->file);
            }

            $transaction->delete();

            return redirect()->route('panel.transaction.index')->with('success', 'transaction berhasil dihapus.');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $err->getMessage());
        }
    }

    public function export(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(
            new TransactionsExport($search, $status, $startDate, $endDate),
            'transactions-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
