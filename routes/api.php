<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TransactionController;
use App\Jobs\ConfirmTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});

Route::get('/transactions/confirm', function () {
    $tx = Transaction::first();

    ConfirmTransaction::dispatch($tx)->afterCommit();

    return 'dispatched';
});
