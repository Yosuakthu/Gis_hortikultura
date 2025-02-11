<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'level_id' => 1, // ID Level Admin
            'name' => 'Risky',
            'email' => 'Risky@test.com',
            'password' => Hash::make('12345'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
