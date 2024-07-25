<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\Point;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShareController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $request->validate([
            'platform' => 'required|string|in:facebook,twitter,whatsapp',
        ]);

        $user = $request->user();

        DB::beginTransaction();

        try {
            $share = $campaignMessage->shares()->create([
                'user_id' => $user->id,
                'platform' => $request->platform,
            ]);

            $campaignMessage->increment('shares_count');

            // Award points to the user
            $pointsAwarded = 10; // As per the project requirements

            $point = Point::firstOrCreate(
                ['user_id' => $user->id],
                ['balance' => 0]
            );
            $point->increment('balance', $pointsAwarded);

            // Record the point transaction
            PointTransaction::create([
                'user_id' => $user->id,
                'points' => $pointsAwarded,
                'transaction_type' => 'share',
                'related_id' => $share->id,
                'related_type' => 'App\Models\Share',
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Shared successfully',
                'points_awarded' => $pointsAwarded,
                'new_total_points' => $point->balance,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to share the post'], 500);
        }
    }
}
