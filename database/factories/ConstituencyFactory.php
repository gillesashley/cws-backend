<?php

namespace Database\Factories;

use App\Models\Constituency;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Constituency>
 */
class ConstituencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Constituency::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->city,
            'region_id' => Region::factory(),
        ];
    }
}
