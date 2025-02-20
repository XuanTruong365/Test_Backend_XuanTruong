<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountsSeeder::class,
            CitizensSeeder::class,
            FlagSeeder::class,
            PeopleFlagSeeder::class,
            PeopleSeeder::class
        ]);
    }
}
