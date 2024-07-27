<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class)->names('admin.users');
    Route::resource('campaigns', CampaignController::class)->names('admin.campaigns');
    Route::resource('withdrawals', WithdrawalController::class)->except(['create', 'store', 'destroy'])->names('admin.withdrawals');
});
