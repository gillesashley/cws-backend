<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Notification $notification)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isAnyAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notification $notification)
    {
        return $user->id === $notification->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notification $notification)
    {
        //
    }
}
