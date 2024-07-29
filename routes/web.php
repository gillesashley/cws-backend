<?php

use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\TargetedMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Middleware\EnsureApiTokenIsValid;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::group(['namespace' => 'Auth'], function () {
    // Login Routes
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
});

// Protected Routes (without API token validation)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class)->except(['show'])->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

// Protected Routes (with API token validation)
Route::middleware([EnsureApiTokenIsValid::class])->group(function () {
    // Targeted Messages (SMS and WhatsApp)
    Route::group(['prefix' => 'targeted-messages', 'as' => 'targeted-messages.'], function () {
        // SMS Campaigns
        Route::get('/sms', [TargetedMessageController::class, 'smsIndex'])->name('sms.index');
        Route::get('/sms/create', [TargetedMessageController::class, 'smsCreate'])->name('sms.create');
        Route::post('/sms', [TargetedMessageController::class, 'smsStore'])->name('sms.store');

        // WhatsApp Campaigns
        Route::get('/whatsapp', [TargetedMessageController::class, 'whatsappIndex'])->name('whatsapp.index');
        Route::get('/whatsapp/create', [TargetedMessageController::class, 'whatsappCreate'])->name('whatsapp.create');
        Route::post('/whatsapp', [TargetedMessageController::class, 'whatsappStore'])->name('whatsapp.store');
    });

    // Withdrawals
    Route::resource('withdrawals', WithdrawalController::class)->except(['create', 'store', 'destroy'])->names('admin.withdrawals');

    // Analytics
    Route::group(['prefix' => 'analytics', 'as' => 'admin.analytics.'], function () {
        Route::get('/', [AnalyticsController::class, 'index'])->name('index');
        Route::get('/user-engagement', [AnalyticsController::class, 'userEngagement'])->name('user-engagement');
        Route::get('/campaign-performance', [AnalyticsController::class, 'campaignPerformance'])->name('campaign-performance');
    });

    // Notifications
    Route::resource('notifications', NotificationController::class)->except(['edit', 'update', 'destroy'])->names('admin.notifications');

    // Point Transactions
    Route::resource('point-transactions', PointTransactionController::class)->only(['index', 'show'])->names('admin.point-transactions');

    // Admin Roles
    Route::resource('admin-roles', AdminRoleController::class)->names('admin.roles');
});

// Error Routes
Route::get('/error/{code}', [ErrorController::class, 'show'])->name('error');
