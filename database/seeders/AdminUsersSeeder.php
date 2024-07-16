<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $constituency = Constituency::inRandomOrder()->first();
        $region = Region::inRandomOrder()->first();

        // Create a Constituency Admin
        User::factory()->create([
            'name' => 'Constituency Admin',
            'email' => 'constituency_admin@example.com',
            'role' => 'constituency_admin',
            'constituency_id' => $constituency->id,
        ]);

        // Create a Regional Admin
        User::factory()->create([
            'name' => 'Regional Admin',
            'email' => 'regional_admin@example.com',
            'role' => 'regional_admin',
            'constituency_id' => $region->constituencies->random()->id,
        ]);

        // Create a National Admin
        User::factory()->create([
            'name' => 'National Admin',
            'email' => 'national_admin@example.com',
            'role' => 'national_admin',
            'constituency_id' => Constituency::inRandomOrder()->first()->id,
        ]);
    }
}
