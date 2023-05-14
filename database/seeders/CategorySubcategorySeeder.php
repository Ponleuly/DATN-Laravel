<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_subcategories')->insert([

            ['id' => 1, 'sub_category' => 'Basas', 'category_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 2, 'sub_category' => 'Vintas', 'category_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 3, 'sub_category' => 'Urbas', 'category_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 4, 'sub_category' => 'Pattas', 'category_id' => 1, 'created_at' => Carbon::now()],

            ['id' => 5, 'sub_category' => 'Hats', 'category_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 6, 'sub_category' => 'Socks', 'category_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 7, 'sub_category' => 'Shoelace', 'category_id' => 2, 'created_at' => Carbon::now()],

        ]);
    }
}
