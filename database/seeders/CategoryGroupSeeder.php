<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_groups')->insert([
            ['id' => 1, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 2, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],

            ['id' => 3, 'category_id' => 2, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 4, 'category_id' => 2, 'group_id' => 2, 'created_at' => Carbon::now()],

        ]);
    }
}
