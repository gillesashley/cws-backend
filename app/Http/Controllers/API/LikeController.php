<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\Like;
use App\Models\Point;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $user = $request->user();

        DB::beginTransaction();

        try {
            Log::info('Starting like creation process', ['user_id' => $user->id, 'campaign_message_id' => $campaignMessage->id]);

            $like = Like::firstOrCreate([
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id,
            ]);

            Log::info('Like created', ['like_id' => $like->id]);

            $campaignMessage->increment('likes_count');
            Log::info('Campaign message likes count incremented');

            // Award points to the user
            $pointsAwarded = 5; // As per the project requirements

            $point = Point::firstOrCreate(
                ['user_id' => $user->id],
                ['balance' => 0]
            );
            $point->increment('balance', $pointsAwarded);

            Log::info('Points awarded to user', ['points_awarded' => $pointsAwarded, 'new_balance' => $point->balance]);

            // Record the point transaction
            $pointTransaction = PointTransaction::create([
                'user_id' => $user->id,
                'point_id' => $point->id,
                'points' => $pointsAwarded,
                'transaction_type' => 'like',
                'related_id' => $like->id,
                'related_type' => 'App\Models\Like',
            ]);

            Log::info('Point transaction created', ['transaction_id' => $pointTransaction->id]);

            DB::commit();

            Log::info('Like process completed successfully');

            return response()->json([
                'message' => 'Liked successfully',
                'points_awarded' => $pointsAwarded,
                'new_total_points' => $point->balance,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Like creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id,
            ]);
            return response()->json(['message' => 'Failed to like the post: ' . $e->getMessage()], 500);
        }
    }
}
