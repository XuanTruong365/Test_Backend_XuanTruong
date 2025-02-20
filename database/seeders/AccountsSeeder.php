<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            [
                'login' => 'user1',
                'password' => Hash::make('password123'),
                'phone' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'login' => 'user2',
                'password' => Hash::make('password456'),
                'phone' => '0912345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'login' => 'admin',
                'password' => Hash::make('admin@123'),
                'phone' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
