<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client as TwilioClient;

class MessagingController extends Controller
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
        try {
            $response = Http::withToken(auth()->user()->api_token)
                ->get(config('app.api_url') . '/messages');

            if ($response->successful()) {
                $messages = $response->json()['data'];
                return view('admin.messages.index', compact('messages'));
            }

            return back()->with('error', 'Unable to fetch messages');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.messages.create');
    }

    public function sendSMS(Request $request)
    {
        try {
            $request->validate([
                'to' => 'required|string',
                'message' => 'required|string',
            ]);

            $this->twilioClient->messages->create(
                $request->to,
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => $request->message,
                ]
            );

            return redirect()->route('admin.messages.index')->with('success', 'SMS sent successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send SMS: ' . $e->getMessage())->withInput();
        }
    }

    public function sendWhatsApp(Request $request)
    {
        try {
            $request->validate([
                'to' => 'required|string',
                'message' => 'required|string',
            ]);

            $this->twilioClient->messages->create(
                "whatsapp:" . $request->to,
                [
                    'from' => "whatsapp:" . config('services.twilio.whatsapp_number'),
                    'body' => $request->message,
                ]
            );

            return redirect()->route('admin.messages.index')->with('success', 'WhatsApp message sent successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send WhatsApp message: ' . $e->getMessage())->withInput();
        }
    }
}
