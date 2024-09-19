<?php

namespace Database\Seeders;

use App\Models\CampaignMessage;
use App\Models\Notification;
use App\Models\PointTransaction;
use App\Models\RewardWithdrawal;
use App\Models\TargetedMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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
    }
}
