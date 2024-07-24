<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $user = $request->user();

        // Check if the user has already liked the message
        $existingLike = $campaignMessage->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked this message'], 400);
        }

        // Create the like
        $like = $campaignMessage->likes()->create([
            'user_id' => $user->id,
        ]);

        // Increment the likes count
        $campaignMessage->increment('likes_count');

        // Award points to the user
        $pointsAwarded = 5; // As per the project requirements
        $user->increment('points', $pointsAwarded);

        // Record the point transaction
        PointTransaction::create([
            'user_id' => $user->id,
            'points' => $pointsAwarded,
            'type' => 'like',
            'description' => 'Liked a campaign message',
        ]);

        return response()->json([
            'message' => 'Liked successfully',
            'points_awarded' => $pointsAwarded,
            'new_total_points' => $user->points,
        ], 201);
    }
}
