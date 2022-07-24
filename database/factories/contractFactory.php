<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class contractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'salary' => $this->faker->randomNumber(5),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now', null),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year', null),
        ];
    }
}
