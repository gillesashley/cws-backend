<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static findOrFail($id)
 * @method static create(array $validated)
 * @method static where(string $string, mixed $email)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'date_of_birth',
        'ghana_card_id',
        'ghana_card_image_path',
        'constituency_id',
        'region_id',
        'area',
        'role',
        'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function campaignMessages()
    {
        return $this->hasMany(CampaignMessage::class);
    }

    public function userActions()
    {
        return $this->hasMany(UserAction::class);
    }

    public function rewardWithdrawals()
    {
        return $this->hasMany(RewardWithdrawal::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function point()
    {
        return $this->hasOne(Point::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function analytics()
    {
        return $this->morphMany(Analytics::class, 'entity');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function isConstituencyAdmin()
    {
        return $this->role === 'constituency_admin';
    }

    public function isRegionalAdmin()
    {
        return $this->role === 'regional_admin';
    }

    public function isNationalAdmin()
    {
        return $this->role === 'national_admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'application_admin';
    }

    public function isAnyAdmin($roles = ['constituency_admin', 'regional_admin', 'national_admin', 'application_admin'])
    {
        return in_array($this->role, $roles);
    }

}
