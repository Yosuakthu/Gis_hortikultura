<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('level')->insert([
            ['id' => 1, 'level' => 'Admin'],
            ['id' => 2, 'level' => 'User'],
        ]);
    }
}
