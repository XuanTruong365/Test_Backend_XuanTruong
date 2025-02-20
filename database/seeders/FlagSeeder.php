<?php

namespace Database\Seeders;

use App\Models\Flag;
use Illuminate\Database\Seeder;

class FlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flag::insert([
            ['color' => 'red', 'x' => 10, 'y' => 20],
            ['color' => 'yellow', 'x' => 30, 'y' => 40],
            ['color' => 'green', 'x' => 50, 'y' => 60],
            ['color' => 'blue', 'x' => 70, 'y' => 80],
        ]);
    }
}
