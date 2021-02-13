<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use UserSeed;

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
        $this->call(\Database\Seeders\UserSeed::class);
        $this->call(CategorySeed::class);
        $this->call(PermissionSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
