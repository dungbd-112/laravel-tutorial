<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SentenceConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sentence_id' => $this->faker->unique(true)->numberBetween(1, 500),
            'position' => '1,2',
        ];
    }
}