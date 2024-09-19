<?php

namespace Database\Seeders;

use App\Models\CampaignMessage;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        print ("\nSeed Like");
        dispatch(fn() => CampaignMessage::get()->flatMap(fn($cm) => Like::factory(mt_rand(3, 20), [
            'campaign_message_id' => $cm->id,
            'user_id' => User::query()->where([
                ['role', 'user'],
                ['constituency_id', $cm->constituency_id],
            ])->inRandomOrder()->first()->id,
        ]))->chunk(200)->each(fn($fbSet) => Like::insert($fbSet->toArray())));

    }
}
