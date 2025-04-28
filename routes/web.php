<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TransactionController;

Route::resource('assets', AssetController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/', function () {
    return view('welcome');
});
