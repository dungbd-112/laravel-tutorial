<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'thumbnail_url' => 'https://firebasestorage.googleapis.com/v0/b/unitasks-57f12.appspot.com/o/images%2Fproject_1.png?alt=media&token=d82082bb-bd08-4ca4-bbc7-474ec9d3868b',
            'bonus' => $this->faker->numberBetween(10, 50),
            'created_user' => 1,
        ];
    }
}