<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class exerciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'desc' => $this->faker->text(50)
        ];
    }
}
