<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\CampaignMessage;
use App\Models\Constituency;
use App\Models\Notification;
use App\Models\PointTransaction;
use App\Models\Region;
use App\Models\RewardWithdrawal;
use App\Models\User;
use App\Policies\AdvertisementPolicy;
use App\Policies\CampaignMessagePolicy;
use App\Policies\ConstituencyPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\PointTransactionPolicy;
use App\Policies\RegionPolicy;
use App\Policies\RewardWithdrawalPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(CampaignMessage::class, CampaignMessagePolicy::class);
        Gate::policy(Constituency::class, ConstituencyPolicy::class);
        Gate::policy(RewardWithdrawal::class, RewardWithdrawalPolicy::class);
        Gate::policy(Region::class, RegionPolicy::class);
        Gate::policy(PointTransaction::class, PointTransactionPolicy::class);
        Gate::policy(Notification::class, NotificationPolicy::class);
        Gate::policy(Advertisement::class, AdvertisementPolicy::class);


        // Define gates
        Gate::define('manage-users', function (User $user) {
            return $user->isAnyAdmin();
        });

        Gate::define('manage-constituency', function (User $user, $constituencyId) {
            return $user->isConstituencyAdmin() && $user->constituency_id === $constituencyId;
        });

        Gate::define('manage-region', function (User $user, $regionId) {
            return $user->isRegionalAdmin() && $user->constituency->region_id === $regionId;
        });

        Gate::define('manage-national', function (User $user) {
            return $user->isNationalAdmin() || $user->isSuperAdmin();
        });

        Gate::define('access-admin-panel', function (User $user) {
            return $user->isAnyAdmin();
        });

        Gate::define('view-analytics', function (User $user) {
            return $user->isAnyAdmin();
        });

        Gate::define('manage-advertisements', function (User $user) {
            return $user->isNationalAdmin() || $user->isSuperAdmin();
        });

        Gate::define('send-notifications', function (User $user) {
            return $user->isConstituencyAdmin() || $user->isRegionalAdmin() || $user->isNationalAdmin() || $user->isSuperAdmin();
        });

        Gate::define('view-user-actions', function (User $user, User $targetUser) {
            return $user->id === $targetUser->id || $user->isAnyAdmin();
        });

        Gate::define('manage-feedback', function (User $user) {
            return $user->isConstituencyAdmin() || $user->isRegionalAdmin() || $user->isNationalAdmin() || $user->isSuperAdmin();
        });

        Gate::define('export-data', function (User $user) {
            return $user->isNationalAdmin() || $user->isSuperAdmin();
        });
    }
}
