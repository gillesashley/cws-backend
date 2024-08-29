<?php

namespace Database\Factories;

use App\Models\CampaignMessage;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'campaign_message_id' => CampaignMessage::factory(),
            'title' => $this->faker->sentence,
            'content' => 'seeded: '.$this->faker->paragraph,
            'is_read' => $this->faker->boolean,
        ];
    }
}
