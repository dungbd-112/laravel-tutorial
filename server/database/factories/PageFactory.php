<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'background_url' => $this->faker->randomElement([
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2FLg4oU6Aq4DxsWdwLByyCax1672904703767_trong.png?alt=media&token=f2566c7e-046d-4e4f-9053-e8fc4fb8a707',
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fj2FtITkWXWvEA2eeiolqNH1672904703836_trong.png?alt=media&token=72ed6b77-9e68-4d7a-8789-def34fb1a7b0',
                'https://firebasestorage.googleapis.com/v0/b/japaneat-6bd5a.appspot.com/o/trash%2Fm7ONzmMXmQkaJ8mj3jrSdI1672904703799_trong.png?alt=media&token=7fb33a72-d89c-46d0-9ce0-49372923dfb3',
            ]),
        ];
    }
}