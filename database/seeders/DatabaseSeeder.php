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
            $constCount = 0;
            $fixDateTimes = fn($user) => [
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'email_verified_at' => now()->toDateTimeString(),
                'password' => $this::$password ??= Hash::make('password'),
                'role' => 'user'
            ] + $user;

            $constituencies->each(function ($constituency) use (&$constCount, $constituencies, $fixDateTimes) {
                $users = array_map($fixDateTimes, User::factory(floor(mt_rand(5, 15)))->make([
                    'constituency_id' => $constituency->id,
                    'region_id' => $constituency->region_id,
                    'area' => fake()->streetAddress(),
                    'role' => 'user'
                ])->toArray());


                DB::table('users')->insert($users);
                User::factory(1)->create(['constituency_id' => $constituency->id, 'role' => 'constituency_admin']);
                // dispatch(fn() => DB::table('users')->insert($users));
                printf("\n" . ++$constCount . '/' . $constituencies->count());

            });
            print ("");


        } catch (\Exception $e) {
            Log::error('Error in DatabaseSeeder: ' . $e->getMessage());
            throw $e;
        }

        // Create campaign messages
        try {
            print ("\nseed campaign messages");

            $campaignMessages = User::query()->where('role', 'constituency_admin')->get()->flatMap(function ($user) {
                return CampaignMessage::factory(mt_rand(3, 10))->make(['user_id' => $user->id, 'constituency_id' => $user->constituency_id]);
            });

            User::query()->where('role', 'constituency_admin')->get()->flatMap(function ($user) {
                return TargetedMessage::factory(mt_rand(3, 10))
                    ->make(['user_id' => $user->id, 'constituency_id' => $user->constituency_id])
                    ->map(fn($tm) => ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()] + $tm->toArray());
            })
                ->chunk(50)
                ->each(fn($tmc, $idx) => [
                    print ("\nSeed TargetedMessage: $idx/" . floor(User::count() / 50)),
                    TargetedMessage::insert($tmc->toArray())
                ]);

            CampaignMessage::insert($campaignMessages->toArray());

            $campaignMessages = CampaignMessage::get();


            print ("\nSeed Feedback");
            dispatch(fn() => $campaignMessages->flatMap(fn($cm) => Feedback::factory(mt_rand(3, 20), [
                'user_id' => User::query()->where([
                    ['role', 'user'],
                    ['constituency_id', $cm->constituency_id],
                    // ['campaign_message_id', $cm->id]
                ])->inRandomOrder()->first()->id,
            ]))->chunk(200)->each(fn($fbSet) => Feedback::insert($fbSet->toArray())));

            print ("\nSeed Like");
            dispatch(fn() => $campaignMessages->flatMap(fn($cm) => Like::factory(mt_rand(3, 20), [
                'campaign_message_id' => $cm->id,
                'user_id' => User::query()->where([
                    ['role', 'user'],
                    ['constituency_id', $cm->constituency_id],
                ])->inRandomOrder()->first()->id,
            ]))->chunk(200)->each(fn($fbSet) => Like::insert($fbSet->toArray())));

            print ("\nSeed Share");
            dispatch(fn() => $campaignMessages->flatMap(fn($cm) => Share::factory(mt_rand(3, 20), [
                'campaign_message_id' => $cm->id,
                'platform' => ['facebook', 'twitter', 'whatsapp'][rand(0, 2)],
                'user_id' => User::query()->where([
                    ['role', 'user'],
                    ['constituency_id', $cm->constituency_id],
                ])->inRandomOrder()->first()->id,
            ]))->chunk(200)->each(fn($fbSet) => Share::insert($fbSet->toArray())));
        } catch (\Exception $e) {
            Log::error('Error in DatabaseSeeder: ' . $e->getMessage());
            throw $e;
        }

        // Create point transactions, reward withdrawals, notifications, advertisements, and feedback
        print ("\nSeed point transactions");

        $maxNotificationPTTUsersLength = min(floor(User::query()->where('role', 'user')->count() * .4), 200);
        $users = User::query()->where('role', 'user')->inRandomOrder()->limit($maxNotificationPTTUsersLength)->get();

        print_r(compact('maxNotificationPTTUsersLength'));
        $users->take($maxNotificationPTTUsersLength)->each(function ($user, $ind) use ($campaignMessages, $maxNotificationPTTUsersLength) {
            print ("\nUserTransactions&Notifications $ind/{$maxNotificationPTTUsersLength}");
            dispatch(function () use ($user, $campaignMessages) {
                PointTransaction::factory(5)->make(['user_id' => $user->id])->chunk(10)->each(fn($ptt) => PointTransaction::insert($ptt->toArray()));
                if (rand(0, 1)) {
                    RewardWithdrawal::factory()->create(['user_id' => $user->id]);
                }
                Notification::factory(3)->make([
                    'user_id' => $user->id,
                    'campaign_message_id' => $campaignMessages->random()->id,
                ])->chunk(10)->each(fn($ns) => Notification::insert($ns->toArray()));
            });
        });

        print ("\nSeed adds");
        Advertisement::factory(20)->create();
    }
}
