<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campaign_message_id',
        'action_type',
        'points_earned'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaignMessage()
    {
        return $this->belongsTo(CampaignMessage::class);
    }
}
