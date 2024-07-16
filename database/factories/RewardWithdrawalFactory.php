<?php

namespace Database\Factories;

use App\Models\RewardWithdrawal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RewardWithdrawal>
 */
class RewardWithdrawalFactory extends Factory
{
    protected $model = RewardWithdrawal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'rejection_reason' => null,
        ];
    }
}
