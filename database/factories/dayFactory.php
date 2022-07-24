<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class dayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sat' => $this->faker->boolean(),
            'sun' => $this->faker->boolean(),
            'mon' => $this->faker->boolean(),
            'tue' => $this->faker->boolean(),
            'wed' => $this->faker->boolean(),
            'thu' => $this->faker->boolean(),
            'fri' => $this->faker->boolean()
        ];
    }
}
