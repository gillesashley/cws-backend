<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'constituency_id',
        'title',
        'content',
        'type',
        'recipients_count',
        'success_count',
        'failure_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function isSmsCampaign()
    {
        return $this->type === 'sms';
    }

    public function isWhatsappCampaign()
    {
        return $this->type === 'whatsapp';
    }

    public function incrementSuccessCount()
    {
        $this->increment('success_count');
    }

    public function incrementFailureCount()
    {
        $this->increment('failure_count');
    }
}
