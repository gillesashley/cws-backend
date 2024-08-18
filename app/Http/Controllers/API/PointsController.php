<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Models\RewardWithdrawal;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $withdrawalHistory = RewardWithdrawal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'balance' => PointTransaction::where('user_id', auth()->id())->sum('points') + 0,
            'withdrawalHistory' => $withdrawalHistory,
        ]);
    }
}
