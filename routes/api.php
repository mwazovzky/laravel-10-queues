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

    DB::transaction(function () use ($tx) {
        // ConfirmTransaction::dispatch($tx);
        // [2023-03-26 06:46:28] local.INFO: ConfirmTransaction::__construct
        // [2023-03-26 06:46:31] local.INFO: ConfirmTransaction::handle
        // [2023-03-26 06:46:31] local.INFO: Route::dispatch

        ConfirmTransaction::dispatch($tx)->afterCommit();
        // [2023-03-26 06:47:45] local.INFO: ConfirmTransaction::__construct  
        // [2023-03-26 06:47:49] local.INFO: Route::dispatch  
        // [2023-03-26 06:47:49] local.INFO: ConfirmTransaction::handle  

        sleep(3);

        logger()->info('Route::dispatch');
    });

    return 'confirmed';
});
