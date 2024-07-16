<?php

namespace App\Policies;

use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PointTransactionPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAnyAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PointTransaction $pointTransaction): bool
    {
        return $user->id === $pointTransaction->user_id || $user->isAnyAdmin();
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
    public function update(User $user, PointTransaction $pointTransaction)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PointTransaction $pointTransaction)
    {
        //
    }
}
