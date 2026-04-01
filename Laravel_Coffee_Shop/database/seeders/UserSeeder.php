<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Single test user
        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@cafe.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bulk users
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'first_name' => "Customer{$i}",
                'last_name' => 'Test',
                'email' => "customer{$i}@test.com",
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
