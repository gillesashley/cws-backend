<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRewardWithdrawalRequest;
use App\Http\Requests\UpdateRewardWithdrawalRequest;
use App\Http\Resources\RewardWithdrawalResource;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Models\RewardWithdrawal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RewardWithdrawalController extends Controller
{

    public function index(Request $request): AnonymousResourceCollection
    {
        if ($request->user()->cannot('viewAny', RewardWithdrawal::class)) {
            abort(403);
        }

        $withdrawals = QueryBuilder::for(RewardWithdrawal::class)
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('status'),
            ])
            ->allowedSorts(['created_at', 'amount'])
            ->allowedIncludes(['user'])
            ->paginate();

        Log::info('API Withdrawals Query: ' . $withdrawals->toSql());
        Log::info('API Withdrawals Count: ' . $withdrawals->count());

        return RewardWithdrawalResource::collection($withdrawals);
    }


    public function show(RewardWithdrawal $rewardWithdrawal, Request $request)
    {
        if ($request->user()->cannot('view', $rewardWithdrawal)) {
            abort(403);
        }

        return new RewardWithdrawalResource(
            QueryBuilder::for(RewardWithdrawal::where('id', $rewardWithdrawal->id))
                ->allowedIncludes(['user'])
                ->first()
        );
    }

    public function store(StoreRewardWithdrawalRequest $request)
    {
        $user = $request->user();
        $amount = $request->input('amount');

        // Check if user has enough points
        $userPoints = Point::where('user_id', $user->id)->first();
        if (!$userPoints || $userPoints->balance < $amount * 50) { // Assuming 1 GHS = 50 points
            return response()->json(['message' => 'Insufficient points for withdrawal'], 400);
        }

        DB::beginTransaction();
        try {
            $withdrawal = RewardWithdrawal::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'status' => 'pending',
            ]);

            // Deduct points from user's balance
            $userPoints->decrement('balance', $amount * 50);

            // Create a point transaction record
            PointTransaction::create([
                'user_id' => $user->id,
                'point_id' => $userPoints->id,
                'points' => - ($amount * 50),
                'transaction_type' => 'withdrawal',
                'related_id' => $withdrawal->id,
                'related_type' => RewardWithdrawal::class,
            ]);

            DB::commit();
            return new RewardWithdrawalResource($withdrawal);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to process withdrawal request'], 500);
        }
    }

    public function update(UpdateRewardWithdrawalRequest $request, RewardWithdrawal $rewardWithdrawal)
    {
        if ($request->user()->cannot('update', $rewardWithdrawal)) {
            abort(403);
        }

        $status = $request->input('status');
        $rejectionReason = $request->input('rejection_reason');

        if ($status === 'approved' && $rewardWithdrawal->status === 'pending') {
            // Process approval logic here (e.g., initiate payment)
            $rewardWithdrawal->status = 'approved';
        } elseif ($status === 'rejected' && $rewardWithdrawal->status === 'pending') {
            $rewardWithdrawal->status = 'rejected';
            $rewardWithdrawal->rejection_reason = $rejectionReason;

            // Refund points to user
            $userPoints = Point::where('user_id', $rewardWithdrawal->user_id)->first();
            $userPoints->increment('balance', $rewardWithdrawal->amount * 50);

            PointTransaction::create([
                'user_id' => $rewardWithdrawal->user_id,
                'point_id' => $userPoints->id,
                'points' => $rewardWithdrawal->amount * 50,
                'transaction_type' => 'withdrawal_refund',
                'related_id' => $rewardWithdrawal->id,
                'related_type' => RewardWithdrawal::class,
            ]);
        }

        $rewardWithdrawal->save();

        return new RewardWithdrawalResource($rewardWithdrawal);
    }
}
