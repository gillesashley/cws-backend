<?php

namespace Database\Factories;

use App\Models\Constituency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TargetedMessage>
 */
class TargetedMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $imageUrls = [
            'https://example.com/image1.jpg',
            'https://example.com/image2.jpg',
            'https://example.com/image3.jpg',
            'https://example.com/image4.jpg',
            'https://example.com/image5.jpg',
        ];


        return [
            'user_id' => User::factory(),
            'constituency_id' => Constituency::factory(),
            'title' => 'seeded: ' . $this->faker->sentence,
            // 'slug' => Str::slug($title),
            'content' => 'seeded: ' . $this->faker->paragraphs(3, true),
            'image_url' => $this->faker->randomElement($imageUrls),
            'type' => ['sms', 'whatsapp', 'all'][random_int(0, 2)],
            'recipients_count' => 0,
            'success_count' => 0,
            'failure_count' => 0,
        ];
    }
}
