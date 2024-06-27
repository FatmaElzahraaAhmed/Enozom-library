<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['name' => 'Good', 'status_id' => 1],
            ['name' => 'Damaged', 'status_id' => 2],
            ['name' => 'Lost', 'status_id' => 3],
            ['name' => 'Borrowed', 'status_id' => 4],
        ]);
    }
}
