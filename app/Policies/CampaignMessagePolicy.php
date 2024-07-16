<?php

namespace App\Policies;

use App\Models\CampaignMessage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CampaignMessagePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view campaign messages
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CampaignMessage $campaignMessage): bool
    {
        return $user->id === $campaignMessage->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isConstituencyAdmin() || $user->isRegionalAdmin() || $user->isNationalAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CampaignMessage $campaignMessage): bool
    {
        return $user->id === $campaignMessage->user_id || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CampaignMessage $campaignMessage): bool
    {
        return $user->id === $campaignMessage->user_id || $user->isSuperAdmin();
    }
}
