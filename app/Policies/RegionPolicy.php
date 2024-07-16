<?php

namespace App\Policies;

use App\Models\Region;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view regions
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Region $region): bool
    {
        return $user->isRegionalAdmin() && $user->constituency->region_id === $region->id || $user->isNationalAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Region $region)
    {
        //
    }
}
