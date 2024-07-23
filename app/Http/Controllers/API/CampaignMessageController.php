<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignMessageRequest;
use App\Http\Requests\UpdateCampaignMessageRequest;
use App\Http\Resources\CampaignMessageResource;
use App\Models\CampaignMessage;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CampaignMessageController extends Controller
{
    public function index()
    {
        $messages = QueryBuilder::for(CampaignMessage::class)
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('constituency_id'),
            ])
            ->allowedSorts(['created_at', 'likes_count', 'shares_count'])
            ->allowedIncludes(['user', 'constituency'])
            ->paginate();

        return CampaignMessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignMessageRequest $request)
    {
        $message = CampaignMessage::create($request->validated() + ['user_id' => $request->user()->id]);
        return new CampaignMessageResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignMessage $campaignMessage)
    {
        return new CampaignMessageResource(
            QueryBuilder::for(CampaignMessage::where('id', $campaignMessage->id))
                ->allowedIncludes(['user', 'constituency'])
                ->first()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignMessageRequest $request, CampaignMessage $campaignMessage)
    {
        if ($request->user()->cannot('update', $campaignMessage)) {
            abort(403);
        }

        $campaignMessage->update($request->validated());
        return new CampaignMessageResource($campaignMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampaignMessage $campaignMessage, Request $request)
    {
        if ($request->user()->cannot('delete', $campaignMessage)) {
            abort(403);
        }
        $campaignMessage->delete();
        return response()->json(null, 204);
    }

    public function incrementReadCount(CampaignMessage $campaignMessage)
    {
        $campaignMessage->increment('reads');
        return response()->json(['reads' => $campaignMessage->reads]);
    }
}
