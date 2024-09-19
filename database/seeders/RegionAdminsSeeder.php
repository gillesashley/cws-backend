<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RegionAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make region admins
        $regions = Region::all()->map(fn($r) => ['email' => "radmin{$r->id}@example.com"])->toArray();

        User::factory(count($regions))->sequence(fn(Sequence $sq) => $regions[$sq->index])->create(['role' => 'regional_admin']);

    }
}
