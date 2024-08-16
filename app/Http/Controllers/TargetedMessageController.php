<?php

namespace App\Http\Controllers;

use App\Models\TargetedMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public function allCreate()
    {
        return view('targeted-messages.all.create');
    }

    public function allStore(Request $request)
    {
        $this->storeMessage($request, 'all');
    }

    public static function getRecipients($user)
    {
        $user = $user ?? User::where('email', session('user')?->email)->firstOrFail();
        return User::select('name', 'id', 'phone')
            ->when($user->role === 'constituency_admin', fn($q) => $q->where('constituency_id', $user->constituency_id))
            ->when($user->role === 'regional_admin', fn($q) => $q->where('region_id', $user->region_id))
            ->get();
    }

    public function smsIndex()
    {
        $messages = TargetedMessage::where('type', 'sms')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $recipients = self::getRecipients(auth()->user());

        return view('targeted-messages.sms.index', compact('messages', 'recipients'));
    }

    public function whatsappIndex()
    {
        $messages = TargetedMessage::where('type', 'whatsapp')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $recipients = self::getRecipients(auth()->user());
        return view('targeted-messages.whatsapp.index', compact('messages', 'recipients'));
    }

    public function smsCreate()
    {
        $constituencyMembers = $this->getConstituencyMembers();
        $recipients = self::getRecipients(auth()->user());
        return view('targeted-messages.sms.create', compact('constituencyMembers', 'recipients'));
    }

    public function whatsappCreate()
    {
        $constituencyMembers = $this->getConstituencyMembers();
        $recipients = self::getRecipients(auth()->user());

        return view('targeted-messages.whatsapp.create', compact('constituencyMembers', 'recipients'));
    }

    public function smsStore(Request $request)
    {
        return $this->storeMessage($request, 'sms');
    }

    public function whatsappStore(Request $request)
    {
        Log::info('whatsappStore.fired.started');
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            // 'recipients' => 'required|array',
            // 'recipients.*' => 'exists:users,id',
            'media.*' => 'sometimes|nullable|file|mimes:jpeg,png,gif,mp4|max:16384', // 16MB max
        ]);
        Log::info('whatsappStore.fired.validated');

        $user = auth()->user() ?? User::where('email', session('user')->email)->firstorfail();
        // $recipients = User::whereIn('id', $request->recipients)->get();
        $recipients = self::getRecipients($user);

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

        Log::info('whatsappStore.fired.message.created');

        $successCount = 0;
        $failureCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $this->sendWhatsAppWithMedia($recipient->phone, $request->content, $mediaUrls);
                Log::info('whatsappStore.fired.message.dispatch.queue');
                $successCount++;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                $failureCount++;
            }
        }
        Log::info('whatsappStore.fired.recipients.count: ' . count($recipients), compact('successCount', 'failureCount'));

        $targetedMessage->update([
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return redirect()->route('targeted-messages.whatsapp.index')
            ->with('success', "Campaign sent. Successful: $successCount, Failed: $failureCount");
    }


    private function storeMessage(Request $request, $type)
    {
        Log::info('sms.fired');
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:160',
            // 'recipients' => 'required|array',
            // 'recipients.*' => 'exists:users,id',
        ]);

        Log::info('sms.fired.validated');
        $user = User::where('email', auth()->user()?->email ?? session('user')->email)->firstorfail();
        $recipients = self::getRecipients(auth()->user());

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
                Log::error($e->getMessage());
                $failureCount++;
            }
        }

        Log::info("success", compact('successCount', 'failureCount'));

        $targetedMessage->update([
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        return redirect()->route('targeted-messages.sms.index')
            ->with('success', "Campaign sent. Successful: $successCount, Failed: $failureCount");
    }

    private function sendSms($to, $message)
    {
        dispatch(
            fn() => $this->twilioClient->messages->create(
                $to,
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => $message,
                ]
            )

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

        dispatch(
            fn() =>
            $this->twilioClient->messages->create(
                "whatsapp:$to",
                $messageData
            )
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
