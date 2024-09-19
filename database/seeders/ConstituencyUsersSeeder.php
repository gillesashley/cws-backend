<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ConstituencyUsersSeeder extends Seeder
{
    static $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $constituencies = Constituency::all();
        $regions = Region::all();

        if ($constituencies->isEmpty() || $regions->isEmpty()) {
            throw new \Exception('No constituencies or regions found. Make sure GhanaRegionsAndConstituenciesSeeder ran successfully.');
        }

        Log::info("Constituencies count: " . $constituencies->count());
        Log::info("Regions count: " . $regions->count());

        // Create users
        try {
            $constCount = 0;
            $fixDateTimes = fn($user) => [
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'email_verified_at' => now()->toDateTimeString(),
                'password' => $this::$password ??= Hash::make('password'),
                'role' => 'user'
            ] + $user;

            $constituencies->each(function ($constituency) use (&$constCount, $constituencies, $fixDateTimes) {
                $users = array_map($fixDateTimes, User::factory(floor(mt_rand(5, 15)))->sequence(fn($sq) => [
                    'constituency_id' => $constituency->id,
                    'region_id' => $constituency->region_id,
                    'area' => fake()->streetAddress(),
                    'role' => 'user',
                    'email' => "user{$sq->index}_{$constituency->region_id}{$constituency->id}@example.com"
                ])->make()->toArray());


                DB::table('users')->insert($users);
                User::factory(1)->create(['constituency_id' => $constituency->id, 'role' => 'constituency_admin']);
                // dispatch(fn() => DB::table('users')->insert($users));
                printf("\n" . ++$constCount . '/' . $constituencies->count());

            });

        } catch (\Exception $e) {
            Log::error('Error in DatabaseSeeder: ' . $e->getMessage());
            throw $e;
        }
    }
}
