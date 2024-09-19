<?php

namespace Database\Seeders;

use App\Models\CampaignMessage;
use App\Models\Share;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        print ("\nSeed Share");
        dispatch(fn() => CampaignMessage::get()->flatMap(fn($cm) => Share::factory(mt_rand(3, 20), [
            'campaign_message_id' => $cm->id,
            'platform' => ['facebook', 'twitter', 'whatsapp'][rand(0, 2)],
            'user_id' => User::query()->where([
                ['role', 'user'],
                ['constituency_id', $cm->constituency_id],
            ])->inRandomOrder()->first()->id,
        ]))->chunk(200)->each(fn($fbSet) => Share::insert($fbSet->toArray())));
    }
}
