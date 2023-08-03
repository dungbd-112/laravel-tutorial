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
        PageObject::factory()->count(499)->create();
    }
}