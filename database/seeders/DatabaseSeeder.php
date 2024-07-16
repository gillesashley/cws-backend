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
use App\Models\RewardWithdrawal;
use App\Models\Share;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Ghana's regions and constituencies
        $this->call(GhanaRegionsAndConstituenciesSeeder::class);

        // Get all constituencies
        $constituencies = Constituency::all();

        // Create users
        $users = User::factory(100)->make()->each(function ($user) use ($constituencies) {
            $user->constituency_id = $constituencies->random()->id;
            $user->save();
            Point::factory()->create(['user_id' => $user->id]);
        });

        // Create campaign messages
        $campaignMessages = CampaignMessage::factory(200)->make()->each(function ($message) use ($constituencies, $users) {
            $constituency = $constituencies->random();
            $user = $users->where('constituency_id', $constituency->id)->random();
            $message->user_id = $user->id;
            $message->constituency_id = $constituency->id;
            $message->save();
        });

        // Create likes and shares
        $campaignMessages->each(function ($message) use ($users) {
            $likeCount = random_int(0, 50);
            $shareCount = random_int(0, 20);

            $likers = $users->random($likeCount);
            $sharers = $users->random($shareCount);

            $likers->each(function ($user) use ($message) {
                Like::factory()->create([
                    'user_id' => $user->id,
                    'campaign_message_id' => $message->id,
                ]);
            });

            $sharers->each(function ($user) use ($message) {
                Share::factory()->create([
                    'user_id' => $user->id,
                    'campaign_message_id' => $message->id,
                ]);
            });

            // Update the counts
            $message->update([
                'likes_count' => $likeCount,
                'shares_count' => $shareCount,
            ]);
        });

        // Create point transactions
        PointTransaction::factory(500)->create([
            'user_id' => $users->random()->id,
        ]);

        // Create reward withdrawals
        RewardWithdrawal::factory(50)->create([
            'user_id' => $users->random()->id,
        ]);

        // Create notifications
        Notification::factory(300)->create([
            'user_id' => $users->random()->id,
            'campaign_message_id' => $campaignMessages->random()->id,
        ]);

        // Create advertisements
        Advertisement::factory(20)->create();

        // Create feedback
        Feedback::factory(100)->create([
            'user_id' => $users->random()->id,
            'campaign_message_id' => $campaignMessages->random()->id,
        ]);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'role' => 'super_admin',
            'constituency_id' => $constituencies->random()->id,
        ]);

        // Create admin users
        $this->call(AdminUsersSeeder::class);
    }
}
