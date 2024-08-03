<?php

namespace App\Http\Controllers;

use App\Models\TargetedMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client as TwilioClient;

class TargetedMessageController extends Controller
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new TwilioClient(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function allIndex()
    {
        return view('targeted-messages.all.index');
    }


    public function smsIndex()
    {
        $messages = TargetedMessage::where('type', 'sms')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('targeted-messages.sms.index', compact('messages'));
    }

    public function whatsappIndex()
    {
        $messages = TargetedMessage::where('type', 'whatsapp')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('targeted-messages.whatsapp.index', compact('messages'));
    }

    public function smsCreate()
    {
        $constituencyMembers = $this->getConstituencyMembers();
        return view('targeted-messages.sms.create', compact('constituencyMembers'));
    }

    public function whatsappCreate()
    {
        $constituencyMembers = $this->getConstituencyMembers();
        return view('targeted-messages.whatsapp.create', compact('constituencyMembers'));
    }

    public function smsStore(Request $request)
    {
        return $this->storeMessage($request, 'sms');
    }

    public function whatsappStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
            'media.*' => 'nullable|file|mimes:jpeg,png,gif,mp4|max:16384', // 16MB max
        ]);

        $user = auth()->user();
        $recipients = User::whereIn('id', $request->recipients)->get();

        $mediaUrls = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $mediaPath = $media->store('whatsapp_media', 'public');
                $mediaUrls[] = Storage::url($mediaPath);
            }
        }

        $targetedMessage = TargetedMessage::create([
            'user_id' => $user->id,
            'constituency_id' => $user->constituency_id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => 'whatsapp',
            'recipients_count' => count($recipients),
            'media_urls' => json_encode($mediaUrls),
        ]);

        $successCount = 0;
        $failureCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $this->sendWhatsAppWithMedia($recipient->phone, $request->content, $mediaUrls);
                $successCount++;
            } catch (\Exception $e) {
                $failureCount++;
            }
        }

        $targetedMessage->update([
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return redirect()->route('targeted-messages.whatsapp.index')
            ->with('success', "Campaign sent. Successful: $successCount, Failed: $failureCount");
    }


    private function storeMessage(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:160',
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
        ]);

        $user = auth()->user();
        $recipients = User::whereIn('id', $request->recipients)->get();

        $targetedMessage = TargetedMessage::create([
            'user_id' => $user->id,
            'constituency_id' => $user->constituency_id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $type,
            'recipients_count' => count($recipients),
        ]);

        $successCount = 0;
        $failureCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $this->sendSms($recipient->phone, $request->content);
                $successCount++;
            } catch (\Exception $e) {
                $failureCount++;
            }
        }

        $targetedMessage->update([
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return redirect()->route('targeted-messages.sms.index')
            ->with('success', "Campaign sent. Successful: $successCount, Failed: $failureCount");
    }

    private function sendSms($to, $message)
    {
        $this->twilioClient->messages->create(
            $to,
            [
                'from' => config('services.twilio.phone_number'),
                'body' => $message,
            ]
        );
    }

    private function sendWhatsAppWithMedia($to, $message, $mediaUrls = [])
    {
        $messageData = [
            'from' => 'whatsapp:' . config('services.twilio.whatsapp_number'),
            'body' => $message,
        ];

        if (!empty($mediaUrls)) {
            $messageData['mediaUrl'] = array_map('asset', $mediaUrls);
        }

        $this->twilioClient->messages->create(
            "whatsapp:$to",
            $messageData
        );
    }


    private function getConstituencyMembers()
    {
        $user = Auth::user();

        if (!$user || !$user->constituency_id || !$user->isConstituencyAdmin()) {
            return collect();
        }

        return User::where('constituency_id', $user->constituency_id)
            ->where('id', '!=', $user->id)
            ->select('id', 'name', 'phone')
            ->get();
    }
}
