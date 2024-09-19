<?php

namespace Database\Seeders;

use App\Models\CampaignMessage;
use App\Models\Notification;
use App\Models\PointTransaction;
use App\Models\RewardWithdrawal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaignMessages = CampaignMessage::get();
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
    }
}
