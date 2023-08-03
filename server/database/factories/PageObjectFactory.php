<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageObjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'page_id' => $this->faker->unique()->numberBetween(1, 500),
            'content' => $this->faker->text(10),
            'audio_url' => 'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fsample_audio.mp3?alt=media&token=846d2697-0301-4ef4-bb8e-c852271d0222',
            'image_url' => 'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fsample_object.jpg?alt=media&token=9cf0c198-59f6-4125-927b-373a9fd5727e'
        ];
    }
}