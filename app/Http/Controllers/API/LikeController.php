<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\Like;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        try {
            DB::beginTransaction();

            $user = $request->user();

            Log::info('Like attempt', [
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id,
                'user' => $user->toArray(),
                'campaign_message' => $campaignMessage->toArray()
            ]);

            $user = $request->user();

            // Check if the user has already liked the message
            $existingLike = $campaignMessage->likes()->where('user_id', $user->id)->first();

            if ($existingLike) {
                Log::info('User already liked the message', ['user_id' => $user->id, 'campaign_message_id' => $campaignMessage->id]);
                DB::rollBack();
                return response()->json(['message' => 'You have already liked this message'], 400);
            }

            // Create the like
            $like = Like::create([
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id
            ]);

            // Increment the likes count
            $campaignMessage->increment('likes_count');

            // Award points to the user
            $pointsAwarded = 5; // As per the project requirements
            $user->increment('points', $pointsAwarded);

            // Record the point transaction
            $user->pointTransactions()->create([
                'amount' => $pointsAwarded,
                'type' => 'like',
                'description' => "Liked campaign message ID: {$campaignMessage->id}"
            ]);

            // Record the point transaction
            PointTransaction::create([
                'user_id' => $user->id,
                'points' => $pointsAwarded,
                'transaction_type' => 'like',
                'related_id' => $campaignMessage->id,
                'related_type' => CampaignMessage::class,
            ]);

            DB::commit();

            Log::info('Like successful', [
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id,
                'points_awarded' => $pointsAwarded
            ]);

            return response()->json([
                'message' => 'Liked successfully',
                'points_awarded' => $pointsAwarded,
                'new_total_points' => $user->points,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in like process', [
                'user_id' => $request->user()->id,
                'campaign_message_id' => $campaignMessage->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'An error occurred while processing your request'], 500);
        }
    }

    public function getLikeStatus(Request $request, CampaignMessage $campaignMessage)
    {
        $user = $request->user();
        $isLiked = $campaignMessage->likes()->where('user_id', $user->id)->exists();

        return response()->json([
            'is_liked' => $isLiked
        ]);
    }
}
