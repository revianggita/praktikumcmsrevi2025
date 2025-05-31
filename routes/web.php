<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InventarisController;

Route::resource('assets', AssetController::class);
Route::resource('dashboard', InventarisController::class)->parameters([
    'dashboard' => 'inventaris'
]);
Route::get('dashboard/export/pdf', [InventarisController::class, 'exportPdf'])->name('dashboard.export.pdf');

Route::resource('transactions', TransactionController::class);

Route::get('/', function () {
    return view('welcome');
});


