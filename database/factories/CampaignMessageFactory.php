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
        $imageUrls = [
            'https://www.google.com/imgres?q=bawumia&imgurl=https%3A%2F%2Fwww.myjoyonline.com%2Fwp-content%2Fuploads%2F2023%2F08%2FDr-Bawumia.jpeg&imgrefurl=https%3A%2F%2Fwww.myjoyonline.com%2Fyour-demands-are-legitimate-and-cannot-be-ignored-bawumia-to-young-ghanaian-demonstrators%2F&docid=a1jrz8ML4gygkM&tbnid=6MIICeVVZH5g4M&vet=12ahUKEwiqk_b7u8WHAxXzW0EAHdTHIW0QM3oECF8QAA..i&w=1600&h=1600&hcb=2&ved=2ahUKEwiqk_b7u8WHAxXzW0EAHdTHIW0QM3oECF8QAA',
            'https://www.google.com/imgres?q=bawumia&imgurl=https%3A%2F%2Fcitinewsroom.com%2Fwp-content%2Fuploads%2F2024%2F04%2FBAWUMIA.jpeg&imgrefurl=https%3A%2F%2Fcitinewsroom.com%2F2024%2F04%2Fbawumia-promises-100-ghanaian-ownership-of-natural-resources-if-elected-president%2F&docid=ZCsWQe7EEj2PkM&tbnid=cS7vtVw4Z5-kPM&vet=12ahUKEwiqk_b7u8WHAxXzW0EAHdTHIW0QM3oECGEQAA..i&w=1200&h=630&hcb=2&ved=2ahUKEwiqk_b7u8WHAxXzW0EAHdTHIW0QM3oECGEQAA',
            'https://example.com/image3.jpg',
            'https://example.com/image4.jpg',
            'https://example.com/image5.jpg',
        ];

        return [
            'user_id' => User::factory(),
            'constituency_id' => Constituency::factory(),
            'title' => $this->faker->sentence,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'image_url' => $this->faker->randomElement($imageUrls),
            'reads' => $this->faker->numberBetween(0, 1000),
            'likes_count' => 0,
            'shares_count' => 0,
        ];
    }
}
