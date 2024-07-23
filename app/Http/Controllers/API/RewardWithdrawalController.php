<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRewardWithdrawalRequest;
use App\Http\Requests\UpdateRewardWithdrawalRequest;
use App\Http\Resources\RewardWithdrawalResource;
use App\Models\RewardWithdrawal;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RewardWithdrawalController extends Controller
{

    public function index(Request $request)
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
        $withdrawal = RewardWithdrawal::create($request->validated() + [
            'user_id' => $request->user()->id,
            'status' => 'pending',
        ]);

        return new RewardWithdrawalResource($withdrawal);
    }

    public function update(UpdateRewardWithdrawalRequest $request, RewardWithdrawal $rewardWithdrawal)
    {
        $rewardWithdrawal->update($request->validated());

        return new RewardWithdrawalResource($rewardWithdrawal);
    }
}
