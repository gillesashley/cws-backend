<?php

namespace App\Http\Controllers;

use App\Models\CampaignMessage;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $like = $campaignMessage->likes()->firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        if ($like->wasRecentlyCreated) {
            $campaignMessage->increment('likes_count');
        }

        return response()->json(['message' => 'Liked successfully'], 201);
    }

    public function destroy(CampaignMessage $campaignMessage)
    {
        $like = $campaignMessage->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            $campaignMessage->decrement('likes_count');
            return response()->json(['message' => 'Like removed successfully'], 200);
        }

        return response()->json(['message' => 'Like not found'], 404);
    }
}
