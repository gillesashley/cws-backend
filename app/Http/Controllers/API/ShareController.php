<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $request->validate([
            'platform' => 'required|string|in:facebook,twitter,whatsapp',
        ]);

        $user = $request->user();

        $share = $campaignMessage->shares()->create([
            'user_id' => $user->id,
            'platform' => $request->platform,
        ]);

        $campaignMessage->increment('shares_count');

        // Award points to the user
        $pointsAwarded = 10; // As per the project requirements
        $user->increment('points', $pointsAwarded);

        // Record the point transaction
        PointTransaction::create([
            'user_id' => $user->id,
            'points' => $pointsAwarded,
            'type' => 'share',
            'description' => "Shared a campaign message on {$request->platform}",
        ]);

        return response()->json([
            'message' => 'Shared successfully',
            'points_awarded' => $pointsAwarded,
            'new_total_points' => $user->points,
        ], 201);
    }
}
