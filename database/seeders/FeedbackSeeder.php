<?php

namespace Database\Seeders;

use App\Models\CampaignMessage;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        print ("\nSeed Feedback");
        dispatch(fn() => CampaignMessage::get()->flatMap(fn($cm) => Feedback::factory(mt_rand(3, 20), [
            'user_id' => User::query()->where([
                ['role', 'user'],
                ['constituency_id', $cm->constituency_id],
                // ['campaign_message_id', $cm->id]
            ])->inRandomOrder()->first()->id,
        ]))->chunk(200)->each(fn($fbSet) => Feedback::insert($fbSet->toArray())));

    }
}
