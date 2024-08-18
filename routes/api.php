<?php

use App\Http\Controllers\API\AnalyticsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CampaignMessageController;
use App\Http\Controllers\API\ConstituencyController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\MessageCampaignController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PointsController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PointTransactionController;
use App\Http\Controllers\API\RewardWithdrawalController;
use App\Http\Controllers\API\ShareController;
use App\Http\Controllers\API\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to campaign with us!'], 200);
});

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-phone', [AuthController::class, 'checkPhoneAvailability']);

Route::apiResource('regions', RegionController::class)->only(['index', 'show']);
Route::apiResource('constituencies', ConstituencyController::class);
Route::get('regions/{region}/constituencies', [ConstituencyController::class, 'getByRegion']);

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/users', UserController::class);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::get('/user-profile', [UserController::class, 'profile']);
    Route::get('/user-balance', [UserController::class, 'getBalance']);

    Route::apiResource('campaign-messages', CampaignMessageController::class);
    Route::get('/constituency-members', [CampaignMessageController::class, 'getConstituencyMembers']);
    Route::post('/send-sms-campaign', [MessageCampaignController::class, 'sendSmsCampaign']);

    Route::post('campaign-messages/{campaignMessage}/like', [LikeController::class, 'store']);
    Route::get('campaign-messages/{campaignMessage}/like-status', [LikeController::class, 'getLikeStatus']);
    Route::delete('campaign-messages/{campaignMessage}/like', [LikeController::class, 'destroy']);
    Route::post('campaign-messages/{campaignMessage}/share', [ShareController::class, 'share']);

    Route::apiResource('point-transactions', PointTransactionController::class);
    Route::apiResource('reward-withdrawals', RewardWithdrawalController::class)->except(['destroy']);
    Route::apiResource('notifications', NotificationController::class)->only(['index', 'show']);
    Route::patch('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);

    Route::get('/points', [PointsController::class, 'index']);

    Route::get('/analytics', [AnalyticsController::class, 'index']);

    Route::post('/validate-registration', [AuthController::class, 'validateRegistration']);
});
