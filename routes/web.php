<?php

use App\Http\Controllers\AdminAccessController;
use App\Http\Controllers\ApplicationSetupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\TargetedMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\PointsAndPaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Middleware\SimpleAuthCheck;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('login', [LoginController::class, 'login'])->name('');
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
Route::middleware([SimpleAuthCheck::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/campaign-monitor', [DashboardController::class, 'campaignMonitor'])->name('campaign-monitor');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // User Management
        Route::resource('users', UserController::class)->except(['show'])->names([
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy',
        ]);

        // Withdrawals
//        Route::resource('withdrawals', WithdrawalController::class)->except(['create', 'store', 'destroy'])->names('withdrawals');
        Route::get('/view-transactions', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::put('admin/withdrawals/{id}', [WithdrawalController::class, 'update'])->name('admin.withdrawals.update');

        // Analytics
        Route::prefix('analytics')->name('analytics.')->group(function () {
            Route::get('/', [AnalyticsController::class, 'index'])->name('index');
            Route::get('/user-engagement', [AnalyticsController::class, 'userEngagement'])->name('user-engagement');
            Route::get('/campaign-performance', [AnalyticsController::class, 'campaignPerformance'])->name('campaign-performance');
        });

        // Notifications
        Route::resource('notifications', NotificationController::class)->except(['edit', 'update', 'destroy'])->names('notifications');

        // Geo Location
        Route::get('/geo-location', [GeoLocationController::class, 'index'])->name('geo-location.index');

        // Support Routes
        Route::get('/support', [SupportController::class, 'index'])->name('support.index');

        // Documentation Routes
        Route::get('/profile', [SupportController::class, 'adminProfile'])->name('support.profile');

        // Admin Access control Route
        Route::get('/admin-access', [AdminAccessController::class, 'index'])->name('admin-access.index');

        // Points and Payment
        Route::get('/points-and-payment', [PointsAndPaymentController::class, 'index'])->name('points-and-payment.index');
        Route::get('/view-transactions', [PointsAndPaymentController::class, 'viewTransactions'])->name('view-transactions');

        // Point Transactions
        Route::resource('point-transactions', PointTransactionController::class)->only(['index', 'show'])->names('point-transactions');

        // Admin Roles
        Route::resource('admin-roles', AdminRoleController::class)->names('roles');

        // Application setup
        Route::get('/banners', [ApplicationSetupController::class, 'banners'])->name('banners');
        Route::get('/events', [ApplicationSetupController::class, 'events'])->name('events');
        Route::get('/manifesto', [ApplicationSetupController::class, 'manifesto'])->name('manifesto');
    });

    // Targeted Messages (SMS and WhatsApp)
    Route::prefix('targeted-messages')->name('targeted-messages.')->group(function () {

        // All Campaigns
        Route::get('/all', [TargetedMessageController::class, 'allIndex'])->name('all.index');
        Route::get('/all/create', [TargetedMessageController::class, 'allCreate'])->name('all.create');
        Route::post('/all', [TargetedMessageController::class, 'allStore'])->name('all.store');

        // SMS Campaigns
        Route::get('/sms', [TargetedMessageController::class, 'smsIndex'])->name('sms.index');
        Route::get('/sms/create', [TargetedMessageController::class, 'smsCreate'])->name('sms.create');
        Route::post('/sms', [TargetedMessageController::class, 'smsStore'])->name('sms.store');

        // WhatsApp Campaigns
        Route::get('/whatsapp', [TargetedMessageController::class, 'whatsappIndex'])->name('whatsapp.index');
        Route::get('/whatsapp/create', [TargetedMessageController::class, 'whatsappCreate'])->name('whatsapp.create');
        Route::post('/whatsapp', [TargetedMessageController::class, 'whatsappStore'])->name('whatsapp.store');
    });
});

// Error Routes
Route::get('/error/{code}', [ErrorController::class, 'show'])->name('error');
