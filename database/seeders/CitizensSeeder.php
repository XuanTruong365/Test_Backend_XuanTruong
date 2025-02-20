<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitizensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('citizens')->insert([
            ['name' => 'Nguyễn Văn A', 'age' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trần Thị B', 'age' => 32, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lê Văn C', 'age' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Phạm Thị D', 'age' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hoàng Văn E', 'age' => 28, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
