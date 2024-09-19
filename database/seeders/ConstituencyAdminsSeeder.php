<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ConstituencyAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $constituency_mappings = Constituency::all()
            ->map(fn($ct) => ['constituency_id' => $ct->id, 'email' => "cadmin{$ct->id}@example.com", 'region_id' => $ct->region_id]);

        // Create a Constituency Admin
        User::factory(count($constituency_mappings))->sequence(fn(Sequence $sq) => ($constituency_mappings[$sq->index]))->create(['role' => 'constituency_admin']);

    }
}
