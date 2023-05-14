<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            ['id' => 1, 'size_number' => "35", 'created_at' => Carbon::now()],
            ['id' => 2, 'size_number' => "36", 'created_at' => Carbon::now()],
            ['id' => 3, 'size_number' => "37", 'created_at' => Carbon::now()],
            ['id' => 4, 'size_number' => "38", 'created_at' => Carbon::now()],
            ['id' => 5, 'size_number' => "39", 'created_at' => Carbon::now()],
            ['id' => 6, 'size_number' => "40", 'created_at' => Carbon::now()],
            ['id' => 7, 'size_number' => "41", 'created_at' => Carbon::now()],
            ['id' => 8, 'size_number' => "42", 'created_at' => Carbon::now()],
            ['id' => 9, 'size_number' => "43", 'created_at' => Carbon::now()],
            ['id' => 10, 'size_number' => "44", 'created_at' => Carbon::now()],
            ['id' => 11, 'size_number' => "45", 'created_at' => Carbon::now()],
            ['id' => 12, 'size_number' => "46", 'created_at' => Carbon::now()],
            ['id' => 13, 'size_number' => "free", 'created_at' => Carbon::now()],

        ]);
    }
}
