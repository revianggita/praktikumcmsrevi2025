<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

// Halaman depan (public)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }

    return view('auth.login');
});

// ✅ Route WAJIB ADA untuk Laravel Breeze agar login/register tidak error
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.index');
})->middleware(['auth'])->name('dashboard');

// Semua route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // CRUD Inventaris
    Route::resource('dashboard', InventarisController::class);
    // ✅ Tambahkan resource route untuk transaksi
    Route::resource('transactions', TransactionController::class);
    // Export PDF
    Route::get('dashboard/export/pdf', [InventarisController::class, 'exportPdf'])->name('dashboard.export.pdf');

    

    // Profile user (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route login/register/logout dari Breeze
require __DIR__.'/auth.php';
