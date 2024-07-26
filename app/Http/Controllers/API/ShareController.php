<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\Point;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShareController extends Controller
{
    public function share(Request $request, CampaignMessage $campaignMessage)
    {
        Log::info('Share request received', [
            'user_id' => $request->user()->id,
            'campaign_message_id' => $campaignMessage->id,
            'platform' => $request->platform,
        ]);

        $request->validate([
            'platform' => 'required|string|in:facebook,twitter,whatsapp,shared,other',
        ]);

        $user = $request->user();

        DB::beginTransaction();

        try {
            Log::info('Starting share creation process', ['user_id' => $user->id, 'campaign_message_id' => $campaignMessage->id, 'platform' => $request->platform]);

            // Check if the user has already shared this message on the same platform
            // $existingShare = $campaignMessage->shares()
            //     ->where('user_id', $user->id)
            //     ->where('platform', $request->platform)
            //     ->first();

            // if ($existingShare) {
            //     DB::rollBack();
            //     return response()->json(['message' => 'You have already shared this message on this platform'], 400);
            // }

            $share = $campaignMessage->shares()->create([
                'user_id' => $user->id,
                'platform' => $request->platform,
            ]);

            Log::info('Share created', ['share_id' => $share->id]);

            $campaignMessage->increment('shares_count');
            Log::info('Campaign message shares count incremented');

            // Award points to the user
            $pointsAwarded = 10; // As per the project requirements

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
                'transaction_type' => 'share',
                'related_id' => $share->id,
                'related_type' => 'App\Models\Share',
            ]);

            Log::info('Point transaction created', ['transaction_id' => $pointTransaction->id]);

            DB::commit();

            Log::info('Share process completed successfully');

            return response()->json([
                'message' => 'Shared successfully',
                'points_awarded' => $pointsAwarded,
                'new_total_points' => $point->balance,
                'shareable_url' => $campaignMessage->shareable_url,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Share creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessage->id,
            ]);
            return response()->json(['message' => 'Failed to share the post: ' . $e->getMessage()], 500);
        }
    }
}
