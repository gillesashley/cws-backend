<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointTransaction>
 */
class PointTransactionFactory extends Factory
{
    protected $model = PointTransaction::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $point = Point::where('user_id', $user->id)->first();

        if (!$point) {
            $point = Point::create(['user_id' => $user->id, 'balance' => 0]);
        }

        return [
            'user_id' => $user->id,
            'point_id' => $point->id,
            'points' => $this->faker->numberBetween(1, 100),
            'transaction_type' => $this->faker->randomElement(['earned', 'spent']),
            'related_id' => null,
            'related_type' => null,
        ];
    }
}
