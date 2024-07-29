<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CampaignMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client as TwilioClient;

class MessageCampaignController extends Controller
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new TwilioClient(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function sendSmsCampaign(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:160',
            'recipients' => 'required|array',
            'recipients.*' => 'required|exists:users,id',
        ]);

        $user = $request->user();

        if (!$user->isConstituencyAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $recipients = User::whereIn('id', $request->recipients)->pluck('phone');

        $successCount = 0;
        $failureCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $this->twilioClient->messages->create(
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

        $campaignMessage = CampaignMessage::create([
            'user_id' => $user->id,
            'constituency_id' => $user->constituency_id,
            'title' => $request->title,
            'content' => $request->message,
            'type' => 'sms',
            'recipients_count' => count($recipients),
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return response()->json([
            'message' => "SMS campaign sent. Successful: $successCount, Failed: $failureCount",
            'campaign' => $campaignMessage,
        ]);
    }
}
