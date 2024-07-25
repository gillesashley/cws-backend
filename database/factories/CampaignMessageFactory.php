<?php

namespace Database\Factories;

use App\Models\Constituency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignMessage>
 */
class CampaignMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'user_id' => User::factory(),
            'constituency_id' => Constituency::factory(),
            'title' => $this->faker->sentence,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'reads' => $this->faker->numberBetween(0, 1000),
            'likes_count' => 0,
            'shares_count' => 0,
        ];
    }
}
