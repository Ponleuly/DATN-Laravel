<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'id' => 1,
                'group_name' => 'Men',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'group_name' => 'Women',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
