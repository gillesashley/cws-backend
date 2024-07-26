<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CampaignMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'constituency_id',
        'title',
        'content',
        'image_url',
        'reads',
        'likes_count',
        'shares_count',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campaignMessage) {
            $campaignMessage->slug = Str::slug($campaignMessage->title) . '-' . Str::random(8);
        });

        static::updating(function ($campaignMessage) {
            if ($campaignMessage->isDirty('title')) {
                $campaignMessage->slug = Str::slug($campaignMessage->title);
            }
        });
    }

    public function getShareableUrlAttribute()
    {
        return config('app.url') . '/campaign/' . $this->slug;
    }

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

    public function incrementLikesCount()
    {
        $this->increment('likes_count');
    }

    public function decrementLikesCount()
    {
        $this->decrement('likes_count');
    }

    public function incrementSharesCount()
    {
        $this->increment('shares_count');
    }
}
