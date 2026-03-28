<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MarketDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/trade', [TradeController::class, 'store'])->name('trade.store');
    Route::get('/markets/live', [MarketDataController::class, 'index'])->name('markets.live');
    
    // Financial Hub (Wallet)
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');

    // History Hub
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::post('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::post('/transactions/{transaction}/approve', [AdminController::class, 'approveTransaction'])->name('transactions.approve');
    Route::post('/transactions/{transaction}/reject', [AdminController::class, 'rejectTransaction'])->name('transactions.reject');
    Route::post('/users/{user}/send-money', [AdminController::class, 'sendMoney'])->name('users.send-money');
    
    // Admin Verification Review
    Route::post('/documents/{document}/approve', [AdminController::class, 'approveDocument'])->name('documents.approve');
    Route::post('/documents/{document}/reject', [AdminController::class, 'rejectDocument'])->name('documents.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Verification Routes
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification', [VerificationController::class, 'store'])->name('verification.store');
});

require __DIR__.'/auth.php';
