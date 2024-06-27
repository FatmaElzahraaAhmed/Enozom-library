<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['name' => 'Good', 'id' => 1],
            ['name' => 'Damaged', 'id' => 2],
            ['name' => 'Lost', 'id' => 3],
            ['name' => 'Borrowed', 'id' => 4],
        ]);
    }
}
