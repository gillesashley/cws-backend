<?php

namespace App\Policies;

use App\Models\Constituency;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConstituencyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view constituencies
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Constituency $constituency): bool
    {
        return $user->isConstituencyAdmin() && $user->constituency_id === $constituency->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isConstituencyAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Constituency $constituency): bool
    {
        return $user->isConstituencyAdmin() && $user->constituency_id === $constituency->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Constituency $constituency): bool
    {
        return $user->isConstituencyAdmin() && $user->constituency_id === $constituency->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Constituency $constituency): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Constituency $constituency): bool
    {
        return $user->isSuperAdmin();
    }
}
