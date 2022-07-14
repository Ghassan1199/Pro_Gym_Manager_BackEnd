<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class subscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'starts_at'=>$this->faker->dateTimeBetween('-1 month','now'),
            'ends_at'=>$this->faker->dateTimeBetween('now','+1 month'),
            'private'=>$this->faker->boolean(),
            'price'=>$this->faker->randomNumber(6),
            'paid_amount'=>$this->faker->randomNumber(5),
            'fully_paid'=>$this->faker->boolean(),
        ];
    }
}
