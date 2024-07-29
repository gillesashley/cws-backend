<?php

use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\MessageCampaignController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\TargetedMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Middleware\EnsureApiTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Protected Routes
Route::middleware([EnsureApiTokenIsValid::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class)->names('admin.users');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    // SMS Campaigns
    Route::get('/sms-campaigns', [TargetedMessageController::class, 'smsIndex'])->name('targeted-messages.sms.index');
    Route::get('/sms-campaigns/create', [TargetedMessageController::class, 'smsCreate'])->name('targeted-messages.sms.create');
    Route::post('/sms-campaigns', [TargetedMessageController::class, 'smsStore'])->name('targeted-messages.sms.store');

    // WhatsApp Campaigns
    Route::get('/whatsapp-campaigns', [TargetedMessageController::class, 'whatsappIndex'])->name('targeted-messages.whatsapp.index');
    Route::get('/whatsapp-campaigns/create', [TargetedMessageController::class, 'whatsappCreate'])->name('targeted-messages.whatsapp.create');
    Route::post('/whatsapp-campaigns', [TargetedMessageController::class, 'whatsappStore'])->name('targeted-messages.whatsapp.store');

    // Withdrawals
    Route::resource('withdrawals', WithdrawalController::class)->except(['create', 'store', 'destroy'])->names('admin.withdrawals');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');
    Route::get('/analytics/user-engagement', [AnalyticsController::class, 'userEngagement'])->name('admin.analytics.user-engagement');
    Route::get('/analytics/campaign-performance', [AnalyticsController::class, 'campaignPerformance'])->name('admin.analytics.campaign-performance');

    // Notifications
    Route::resource('notifications', NotificationController::class)->except(['edit', 'update', 'destroy'])->names('admin.notifications');

    // Point Transactions
    Route::resource('point-transactions', PointTransactionController::class)->only(['index', 'show'])->names('admin.point-transactions');

    // Admin Roles
    Route::resource('admin-roles', AdminRoleController::class)->names('admin.roles');
});

Route::get('/error/{code}', [ErrorController::class, 'show'])->name('error');
