<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar inventaris di halaman transaksi
     */
    public function index()
    {
        $inventarisList = Inventaris::all();
        return view('transactions.index', compact('inventarisList'));
    }

    /**
     * Menampilkan form edit transaksi (stok masuk/keluar) untuk inventaris tertentu
     */
    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return view('transactions.edit', compact('inventaris'));
    }

    /**
     * Menyimpan perubahan stok dan mencatat transaksi baru
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $inventaris = Inventaris::findOrFail($id);

        // Update stok berdasarkan jenis transaksi
        if ($request->type === 'masuk') {
            $inventaris->stock += $request->quantity;
        } elseif ($request->type === 'keluar') {
            if ($inventaris->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
            }
            $inventaris->stock -= $request->quantity;
        }

        $inventaris->save();

        // Simpan riwayat transaksi
        Transaction::create([
            'inventaris_id' => $inventaris->id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat dan stok diperbarui.');
    }

    /**
     * (Opsional) Menampilkan daftar riwayat transaksi
     */
    public function showRiwayat()
    {
        $transactions = Transaction::with('inventaris')->orderBy('created_at', 'asc')->get();
        return view('transactions.riwayat', compact('transactions'));
    }

    // Jika tidak digunakan, bisa hapus metode create(), store(), destroy()
}
