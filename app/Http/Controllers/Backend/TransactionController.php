<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::latest()
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
                'message'
            ])->paginate(5);

        return view('backend.transactions.index', [
            'transactions' => $transaction,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //`
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
