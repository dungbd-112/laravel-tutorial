<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($story_id = 1; $story_id <= 50; $story_id++) {
            Page::factory(10)->create([
                'story_id' => $story_id,
            ]);
        }
    }
}