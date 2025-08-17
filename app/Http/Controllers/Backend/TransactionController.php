<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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

        return redirect()->route('panel.transaction.index')
            ->with('success', 'Transaction status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
