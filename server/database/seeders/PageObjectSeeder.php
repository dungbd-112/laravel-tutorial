<?php

namespace Database\Seeders;

use App\Models\PageObject;
use Illuminate\Database\Seeder;

class PageObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($page_id = 1; $page_id <= 500; $page_id++) {
            PageObject::factory(3)->create([
                'page_id' => $page_id,
            ]);
        }
    }
}