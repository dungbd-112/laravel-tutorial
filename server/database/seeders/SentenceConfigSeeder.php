<?php

namespace Database\Seeders;

use App\Models\SentenceConfig;
use Illuminate\Database\Seeder;

class SentenceConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($page_id = 1; $page_id <= 500; $page_id++) {
            SentenceConfig::factory(1)->create([
                'page_id' => $page_id,
            ]);
        }
    }
}