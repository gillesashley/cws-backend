<?php

namespace App\Http\Controllers;

use App\Models\TargetedMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return $this->storeMessage($request, 'whatsapp');
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
                if ($type === 'sms') {
                    $this->sendSms($recipient->phone, $request->content);
                } else {
                    $this->sendWhatsApp($recipient->phone, $request->content);
                }
                $successCount++;
            } catch (\Exception $e) {
                $failureCount++;
            }
        }

        $targetedMessage->update([
            'success_count' => $successCount,
            'failure_count' => $failureCount,
        ]);

        $route = $type === 'sms' ? 'targeted-messages.sms.index' : 'targeted-messages.whatsapp.index';
        return redirect()->route($route)
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

    private function sendWhatsApp($to, $message)
    {
        $this->twilioClient->messages->create(
            "whatsapp:$to",
            [
                'from' => "whatsapp:" . config('services.twilio.whatsapp_number'),
                'body' => $message,
            ]
        );
    }

    private function getConstituencyMembers()
    {
        $user = Auth::user();

        if (!$user) {
            // Handle the case where there's no authenticated user
            return collect();
        }

        if (!$user->constituency_id) {
            // Handle the case where the user doesn't have a constituency
            return collect();
        }

        // Assuming you have a method to check if the user is a constituency admin
        if (!$user->isConstituencyAdmin()) {
            // Handle the case where the user is not a constituency admin
            return collect();
        }

        return User::where('constituency_id', $user->constituency_id)
            ->where('id', '!=', $user->id)
            ->select('id', 'name', 'phone')
            ->get();
    }
}
