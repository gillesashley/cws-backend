<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\RewardWithdrawal;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $points = Point::where('user_id', $user->id)->first();
        $withdrawalHistory = RewardWithdrawal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'balance' => $points ? $points->balance : 0,
            'withdrawalHistory' => $withdrawalHistory,
        ]);
    }
}
