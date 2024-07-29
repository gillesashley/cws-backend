<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignMessageRequest;
use App\Http\Requests\UpdateCampaignMessageRequest;
use App\Http\Resources\CampaignMessageResource;
use App\Models\CampaignMessage;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Twilio\Rest\Client as TwilioClient;

class CampaignMessageController extends Controller
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new TwilioClient(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function index()
    {
        $messages = QueryBuilder::for(CampaignMessage::class)
            ->allowedFilters([
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('constituency_id'),
            ])
            ->allowedSorts(['created_at', 'likes_count', 'shares_count'])
            ->allowedIncludes(['user', 'constituency'])
            ->paginate(10);

        return CampaignMessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignMessageRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('campaign_images', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $message = CampaignMessage::create($data + ['user_id' => $request->user()->id]);
        return new CampaignMessageResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignMessage $campaignMessage)
    {
        $campaignMessage->increment('reads');

        UserAction::create([
            'user_id' => Auth::id(),
            'campaign_message_id' => $campaignMessage->id,
            'action_type' => 'read',
        ]);

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

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($campaignMessage->image_url) {
                Storage::delete(str_replace('/storage/', 'public/', $campaignMessage->image_url));
            }

            $path = $request->file('image')->store('campaign_images', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $campaignMessage->update($data);
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

    public function sendSmsCampaign(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:160',
            'recipients' => 'required|array',
            'recipients.*' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $user = $request->user();

        if (!$user->isConstituencyAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $successCount = 0;
        $failureCount = 0;

        foreach ($request->recipients as $recipient) {
            try {
                $message = $this->twilioClient->messages->create(
                    $recipient,
                    [
                        'from' => config('services.twilio.phone_number'),
                        'body' => $request->message,
                    ]
                );
                $successCount++;
            } catch (\Exception $e) {
                $failureCount++;
            }
        }

        // Create a new campaign message
        $campaignMessage = CampaignMessage::create([
            'user_id' => $user->id,
            'constituency_id' => $user->constituency_id,
            'title' => 'SMS Campaign',
            'content' => $request->message,
            'type' => 'sms',
            'recipients_count' => count($request->recipients),
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return response()->json([
            'message' => "SMS campaign sent. Successful: $successCount, Failed: $failureCount",
            'campaign' => new CampaignMessageResource($campaignMessage),
        ]);
    }
}
