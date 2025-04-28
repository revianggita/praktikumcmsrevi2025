<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['asset', 'user'])->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $assets = Asset::all();
        $users = User::all();
        return view('transactions.create', compact('assets', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:masuk,keluar,rusak,pindah',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $assets = Asset::all();
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'assets', 'users'));
    }
    public function show(Transaction $transaction)
    {
        $assets = Asset::all();
        $users = User::all();
        return view('transactions.show', compact('transaction', 'assets', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:masuk,keluar,rusak,pindah',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
