<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Share extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'campaign_message_id', 'platform'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaignMessage()
    {
        return $this->belongsTo(CampaignMessage::class);
    }
}
