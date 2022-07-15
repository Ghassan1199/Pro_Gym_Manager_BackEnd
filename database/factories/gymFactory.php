<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class gymFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name(),
            'address'=>$this->faker->address()
        ];
    }
}
