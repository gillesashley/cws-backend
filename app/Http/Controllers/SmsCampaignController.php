<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client as TwilioClient;

class SmsCampaignController extends Controller
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
        // Fetch constituency members
        $response = Http::withToken(Session::get('api_token'))
            ->get(config('app.api_url') . '/constituency-members');

        if ($response->successful()) {
            $constituencyMembers = $response->json()['data'];
            return view('sms-campaigns.index', compact('constituencyMembers'));
        }

        return back()->with('error', 'Unable to fetch constituency members');
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:160',
            'recipients' => 'required|array',
            'recipients.*' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

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

        // Log the campaign
        $response = Http::withToken(Session::get('api_token'))
            ->post(config('app.api_url') . '/log-sms-campaign', [
                'message' => $request->message,
                'recipients_count' => count($request->recipients),
                'success_count' => $successCount,
                'failure_count' => $failureCount,
            ]);

        return back()->with('success', "SMS campaign sent. Successful: $successCount, Failed: $failureCount");
    }
}
