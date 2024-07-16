<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdvertisementPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->isNationalAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Advertisement $advertisement)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isNationalAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Advertisement $advertisement): bool
    {
        return $user->isNationalAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Advertisement $advertisement): bool
    {
        return $user->isSuperAdmin();
    }
}
