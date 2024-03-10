<?php

namespace Database\Factories;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PlayerSeason>
 */
class PlayerSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'season' => $this->faker->numberBetween(1, 12),
            'player_id' => User::factory(),
            'damage' => $this->faker->numberBetween(0, 1000000),
            'is_observer' => $this->faker->boolean,
            'is_star' => $this->faker->boolean,
            'guild_id' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
