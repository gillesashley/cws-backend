<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'constituency_id', 'title', 'content', 'reads'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }

    public function userActions()
    {
        return $this->hasMany(UserAction::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function analytics()
    {
        return $this->morphMany(Analytics::class, 'entity');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
