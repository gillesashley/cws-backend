<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointTransactionResource;
use App\Models\Point;
use App\Models\PointTransaction;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PointTransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', PointTransaction::class)) {
            abort(403);
        }

        $transactions = QueryBuilder::for(PointTransaction::class)
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('transaction_type'),
            ])
            ->allowedSorts(['created_at', 'points'])
            ->allowedIncludes(['user'])
            ->paginate();

        return PointTransactionResource::collection($transactions);
    }

    public function show(Request $request, PointTransaction $pointTransaction)
    {
        if ($request->user()->cannot('view', $pointTransaction)) {
            abort(403);
        }

        return new PointTransactionResource(
            QueryBuilder::for(PointTransaction::where('id', $pointTransaction->id))
                ->allowedIncludes(['user'])
                ->first()
        );
    }

    // If you have a store method, it would look like this:
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', PointTransaction::class)) {
            abort(403);
        }

        // Validation logic here
        $validatedData = $request->validate([
            // 'points' => 'required|integer',
            'transaction_type' => 'required|string',
            'related_id' => 'nullable|integer',
            'related_type' => 'nullable|string',
        ]);

        $recentPoints = PointTransaction::where($validatedData + ['user_id' => auth()->id()])->where('created_at', '>=', now()->subMinutes(30))->latest()->get();
        if (
            $recentPoints->count()
        ) {
            $cooldown_ends_at = Carbon::parse($recentPoints->first()->created_at)->addMinutes(30)->fromNow();
            abort(208, "You can earn points for this message after cool down period ends {$cooldown_ends_at}");
        }

        $readCounts = PointTransaction::where($validatedData + ['user_id' => auth()->id()])->count();

        $pointTransaction = PointTransaction::create($validatedData + [
            'user_id' => $request->user()->id,
            'point_id' => Point::firstOrCreate(['user_id' => auth()->id()])->id,
            'points' => intval(30 * pow(0.70, $readCounts))
        ]);

        return new PointTransactionResource($pointTransaction);
    }

    // If you have an update method, it would look like this:
    public function update(Request $request, PointTransaction $pointTransaction)
    {
        if ($request->user()->cannot('update', $pointTransaction)) {
            abort(403);
        }

        // Validation logic here
        $validatedData = $request->validate([
            'points' => 'sometimes|integer',
            'transaction_type' => 'sometimes|string',
            'related_id' => 'nullable|integer',
            'related_type' => 'nullable|string',
        ]);

        $pointTransaction->update($validatedData);

        return new PointTransactionResource($pointTransaction);
    }

    // If you have a destroy method, it would look like this:
    public function destroy(Request $request, PointTransaction $pointTransaction)
    {
        if ($request->user()->cannot('delete', $pointTransaction)) {
            abort(403);
        }

        $pointTransaction->delete();

        return response()->json(null, 204);
    }
}
