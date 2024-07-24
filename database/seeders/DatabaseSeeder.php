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
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // GhanaRegionsAndConstituenciesSeeder::class,
            AdminUsersSeeder::class,
        ]);

        $constituencies = Constituency::all();
        $regions = Region::all();

        if ($constituencies->isEmpty() || $regions->isEmpty()) {
            throw new \Exception('No constituencies or regions found. Make sure GhanaRegionsAndConstituenciesSeeder ran successfully.');
        }

        // Create a Super Admin user
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'role' => 'super_admin',
            'constituency_id' => $constituencies->random()->id,
            'region_id' => $regions->random()->id,
        ]);

        // Create users
        $users = User::factory(100)->create()->each(function ($user) use ($constituencies) {
            $constituency = $constituencies->random();
            $user->constituency_id = $constituency->id;
            $user->region_id = $constituency->region_id;
            $user->save();

            Point::factory()->create(['user_id' => $user->id]);
        });

        // Create campaign messages
        $campaignMessages = CampaignMessage::factory(200)->create()->each(function ($message) use ($constituencies, $users) {
            $constituency = $constituencies->random();
            $user = $users->where('constituency_id', $constituency->id)->random();
            $message->user_id = $user->id;
            $message->constituency_id = $constituency->id;
            $message->save();
        });

        // Create likes and shares
        foreach ($campaignMessages as $message) {
            $likeCount = random_int(0, 50);
            $shareCount = random_int(0, 20);

            $likers = $users->random($likeCount)->pluck('id')->unique();
            $sharers = $users->random($shareCount)->pluck('id')->unique();

            $likes = $likers->map(function ($userId) use ($message) {
                return ['user_id' => $userId, 'campaign_message_id' => $message->id];
            });
            Like::insert($likes->toArray());

            $shares = $sharers->map(function ($userId) use ($message) {
                return [
                    'user_id' => $userId,
                    'campaign_message_id' => $message->id,
                    'platform' => ['facebook', 'twitter', 'whatsapp'][rand(0, 2)]
                ];
            });
            Share::insert($shares->toArray());

            $message->update([
                'likes_count' => $likeCount,
                'shares_count' => $shareCount,
            ]);
        }

        // Create point transactions, reward withdrawals, notifications, advertisements, and feedback
        PointTransaction::factory(500)->create(['user_id' => $users->random()->id]);
        RewardWithdrawal::factory(50)->create(['user_id' => $users->random()->id]);
        Notification::factory(300)->create([
            'user_id' => $users->random()->id,
            'campaign_message_id' => $campaignMessages->random()->id,
        ]);
        Advertisement::factory(20)->create();
        Feedback::factory(100)->create([
            'user_id' => $users->random()->id,
            'campaign_message_id' => $campaignMessages->random()->id,
        ]);
    }
}
