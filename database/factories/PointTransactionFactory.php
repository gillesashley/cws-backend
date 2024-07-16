<?php

namespace Database\Factories;

use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointTransaction>
 */
class PointTransactionFactory extends Factory
{
    protected $model = PointTransaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::factory(),
            'points' => $this->faker->numberBetween(1, 100),
            'transaction_type' => $this->faker->randomElement(['earned', 'spent']),
            'related_id' => null,
            'related_type' => null,
        ];
    }
}
