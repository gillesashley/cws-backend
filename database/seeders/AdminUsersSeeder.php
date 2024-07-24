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
        User::firstOrCreate(
            ['email' => 'constituency_admin@example.com'],
            [
                'name' => 'Constituency Admin',
                'role' => 'constituency_admin',
                'constituency_id' => $constituency->id,
                'region_id' => $constituency->region_id,
                'phone' => '1234567890',
                'password' => bcrypt('password'),
                'date_of_birth' => now()->subYears(30),
                'ghana_card_id' => 'GHA-' . str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT) . '-1',
                'ghana_card_image_path' => 'path/to/default/image.jpg',
            ]
        );

        // Create a Regional Admin
        User::firstOrCreate(
            ['email' => 'regional_admin@example.com'],
            [
                'name' => 'Regional Admin',
                'role' => 'regional_admin',
                'constituency_id' => $region->constituencies->random()->id,
                'region_id' => $region->id,
                'phone' => '2345678901',
                'password' => bcrypt('password'),
                'date_of_birth' => now()->subYears(35),
                'ghana_card_id' => 'GHA-' . str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT) . '-1',
                'ghana_card_image_path' => 'path/to/default/image.jpg',
            ]
        );

        // Create a National Admin
        User::firstOrCreate(
            ['email' => 'national_admin@example.com'],
            [
                'name' => 'National Admin',
                'role' => 'national_admin',
                'constituency_id' => Constituency::inRandomOrder()->first()->id,
                'region_id' => Region::inRandomOrder()->first()->id,
                'phone' => '3456789012',
                'password' => bcrypt('password'),
                'date_of_birth' => now()->subYears(40),
                'ghana_card_id' => 'GHA-' . str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT) . '-1',
                'ghana_card_image_path' => 'path/to/default/image.jpg',
            ]
        );
    }
}
