<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\CampaignMessage;
use App\Models\Constituency;
use App\Models\Feedback;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Models\Region;
use App\Models\RewardWithdrawal;
use App\Models\Share;
use App\Models\TargetedMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    static $password;
    public function run(): void
    {
        $this->call([
            GhanaRegionsAndConstituenciesSeeder::class,
        ]);


        // Create campaign messages


        // Create point transactions, reward withdrawals, notifications, advertisements, and feedback

        Log::info('Environment: ' . APP::environment());

        if (User::query()->where('role', 'application_admin')->doesntExist()) {
            $password = App::environment('production') ? \Faker\Factory::create()->word : 'password';

            User::factory()->create(['email' => 'admin@example.com', 'password' => $password]);
        }

        if (APP::environment('production')) {
            return;
        }


        Log::info("db:refresh [non-prod tables]");

        $this->call([
            AdminUsersSeeder::class,
            ConstituencyAdminsSeeder::class,
            RegionAdminsSeeder::class,
            ConstituencyUsersSeeder::class,
            CampaignMessagesSeeder::class,
            LikesSeeder::class,
            FeedbackSeeder::class,
            ShareSeeder::class,
        ]);

        Advertisement::factory(20)->create();


    }

}
