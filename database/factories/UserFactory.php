<?php

namespace Database\Factories;

use App\Models\Constituency;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;



    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $constituency = Constituency::inRandomOrder()->first();

        if (!$constituency) {
            throw new \Exception('No constituencies found. Make sure GhanaRegionsAndConstituenciesSeeder ran successfully.');
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->regexify('\+233(20|50|24|55)\d{5}2'),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'ghana_card_id' => $this->faker->unique()->regexify('GHA-[0-9]{12}-1'),
            'ghana_card_image_path' => $this->faker->imageUrl(640, 480, 'people'),
            'constituency_id' => $constituency->id,
            'region_id' => $constituency->region_id,
            'area' => $this->faker->streetAddress,
            'role' => $this->faker->randomElement(['user', 'constituency_admin', 'regional_admin', 'national_admin', 'application_admin']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
