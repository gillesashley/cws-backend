<?php

namespace App\Http\Controllers;

use App\Models\CampaignMessage;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function store(Request $request, CampaignMessage $campaignMessage)
    {
        $request->validate([
            'platform' => 'required|string|in:facebook,twitter,whatsapp',
        ]);

        $share = $campaignMessage->shares()->create([
            'user_id' => $request->user()->id,
            'platform' => $request->platform,
        ]);

        $campaignMessage->increment('shares_count');

        return response()->json(['message' => 'Shared successfully'], 201);
    }
}
