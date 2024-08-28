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
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GhanaRegionsAndConstituenciesSeeder::class,
            AdminUsersSeeder::class,
        ]);

        $constituencies = Constituency::all();
        $regions = Region::all();

        if ($constituencies->isEmpty() || $regions->isEmpty()) {
            throw new \Exception('No constituencies or regions found. Make sure GhanaRegionsAndConstituenciesSeeder ran successfully.');
        }

        Log::info("Constituencies count: " . $constituencies->count());
        Log::info("Regions count: " . $regions->count());

        // Create users
        try {
            $constituencies->each(function ($constituency) {
                $users = User::factory(20)->make([
                    'constituency_id' => $constituency->id,
                    'region_id' => $constituency->region_id,
                    'area' => fake()->streetAddress(),
                    'created_at' => now()->format('Y-m-d H:i:s'),

                ])->toArray();

                print_r([$users[0],$users[0]['created_at']]);
                DB::table('users')->insert($users);

            });


            // $users = User::factory(50)->create()->each(function ($user) use ($constituencies) {
            //     Log::info("Creating user. Constituencies count: " . $constituencies->count());
            //     $constituency = $constituencies->random();
            //     $user->constituency_id = $constituency->id;
            //     $user->region_id = $constituency->region_id;
            //     $user->area = fake()->streetAddress();
            //     $user->save();

            //     Point::factory()->create(['user_id' => $user->id]);
            // });
        } catch (\Exception $e) {
            Log::error('Error in DatabaseSeeder: ' . $e->getMessage());
            throw $e;
        }

        // Create campaign messages
        try {
            $users = User::all();
            $campaignMessages = CampaignMessage::factory(20)->create()->each(function ($message) use ($constituencies, $users) {
                $constituency = $constituencies->random();
                $usersInConstituency = $users->where('constituency_id', $constituency->id);

                if ($usersInConstituency->isEmpty()) {
                    Log::warning("No users found for constituency {$constituency->id}. Skipping this campaign message.");
                    return; // Skip this iteration
                }

                $user = $usersInConstituency->random();
                $message->user_id = $user->id;
                $message->constituency_id = $constituency->id;
                $message->save();
            });
        } catch (\Exception $e) {
            Log::error('Error in DatabaseSeeder: ' . $e->getMessage());
            throw $e;
        }

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
        $users->each(function ($user) use ($campaignMessages) {
            PointTransaction::factory(5)->create(['user_id' => $user->id]);
            if (rand(0, 1)) {
                RewardWithdrawal::factory()->create(['user_id' => $user->id]);
            }
            Notification::factory(3)->create([
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessages->random()->id,
            ]);
        });

        Advertisement::factory(20)->create();

        $users->take(20)->each(function ($user) use ($campaignMessages) {
            Feedback::factory()->create([
                'user_id' => $user->id,
                'campaign_message_id' => $campaignMessages->random()->id,
            ]);
        });
    }
}
