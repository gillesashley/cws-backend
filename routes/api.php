<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CampaignMessageController;
use App\Http\Controllers\API\ConstituencyController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PointTransactionController;
use App\Http\Controllers\API\RewardWithdrawalController;
use App\Http\Controllers\API\ShareController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to campaign with us!'], 200);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/users', UserController::class);
    Route::post('change-password', [UserController::class, 'changePassword']);

    Route::apiResource('/constituencies', ConstituencyController::class);

    Route::apiResource('campaign-messages', CampaignMessageController::class);

    Route::post('campaign-messages/{campaignMessage}/like', [LikeController::class, 'store']);
    Route::delete('campaign-messages/{campaignMessage}/like', [LikeController::class, 'destroy']);
    Route::post('campaign-messages/{campaignMessage}/share', [ShareController::class, 'store']);

    Route::apiResource('point-transactions', PointTransactionController::class)->only(['index', 'show']);
    Route::apiResource('reward-withdrawals', RewardWithdrawalController::class)->except(['destroy']);
    Route::apiResource('notifications', NotificationController::class)->only(['index', 'show']);
    Route::patch('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);

    Route::apiResource('regions', RegionController::class)->only(['index', 'show']);
});
