<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SentenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->unique(true)->sentence(10),
            'page_id' => $this->faker->unique()->numberBetween(1, 500),
            'audio_url' => 'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fsample_audio.mp3?alt=media&token=846d2697-0301-4ef4-bb8e-c852271d0222',
        ];
    }
}