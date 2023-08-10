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
            'content' => $this->faker->unique(true)->sentence(5),
            'audio_url' => $this->faker->randomElement([
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fapple.mp3?alt=media&token=5d7a4bf8-abef-4902-990b-c5b04a0bb018',
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fboiling%20water.mp3?alt=media&token=b410758c-d6f3-4235-9999-5528bd43df4b',
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fbowl.mp3?alt=media&token=d3cbc4a9-4827-430d-ad25-5dd2867bcb8f',
            ]),
        ];
    }
}