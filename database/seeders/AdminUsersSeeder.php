<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $password = bcrypt('password');

        if (!$constituency || !$region) {
            throw new \Exception('No constituencies or regions found. Make sure GhanaRegionsAndConstituenciesSeeder ran successfully.');
        }



        // Create a National Admin
        User::firstOrCreate(
            ['email' => 'national_admin@example.com'],
            [
                'name' => 'National Admin',
                'role' => 'national_admin',
                'constituency_id' => Constituency::inRandomOrder()->first()->id,
                'region_id' => Region::inRandomOrder()->first()->id,
                'area' => fake()->streetAddress(),
                'phone' => '3456789012',
                'password' => $password,
                'date_of_birth' => now()->subYears(40),
                'ghana_card_id' => 'GHA-' . str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT) . '-1',
                'ghana_card_image_path' => 'path/to/default/image.jpg',
            ]
        );

    }
}
