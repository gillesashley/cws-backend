<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function campaignMessages()
    {
        return $this->hasMany(CampaignMessage::class);
    }
}
