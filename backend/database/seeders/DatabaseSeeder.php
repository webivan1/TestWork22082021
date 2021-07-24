<?php

namespace Database\Seeders;

use App\Models\Hotel\Entity\Hotel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Hotel::factory(30)->create();
    }
}
