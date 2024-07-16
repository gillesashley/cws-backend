<?php

namespace App\Policies;

use App\Models\RewardWithdrawal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RewardWithdrawalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Anyone can request a withdrawal
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RewardWithdrawal $rewardWithdrawal): bool
    {
        return $user->isSuperAdmin(); // Only super admins can approve/reject withdrawals
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RewardWithdrawal $rewardWithdrawal): bool
    {
        return $user->isSuperAdmin();
    }
}
