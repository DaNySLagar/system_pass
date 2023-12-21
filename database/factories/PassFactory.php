<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pass>
 */
class PassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,70),

            'motive' => $this->faker->sentence(),
            'place' => $this->faker->secondaryAddress(),
            'estado' => $this->faker->numberBetween($min = 0, $max = 3),
            'time_id' => rand(1,9),
            'date' => $this->faker->date(),

        ];
    }
}
