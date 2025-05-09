<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InventarisController;

Route::resource('assets', AssetController::class);
Route::resource('dashboard', InventarisController::class)->parameters([
    'dashboard' => 'inventaris'
]);

Route::resource('transactions', TransactionController::class);

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [InventarisController::class, 'index']);
// Route::get('/dashboard/create', [InventarisController::class, 'create'])->name('dashboard.create');
