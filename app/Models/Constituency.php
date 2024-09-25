<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function campaignMessages()
    {
        return $this->hasMany(CampaignMessage::class);
    }

    public function banners()
    {
        return $this->morphMany(Banner::class, 'bannerable');
    }
}
