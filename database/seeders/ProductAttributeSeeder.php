<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_attributes')->insert([
            ['id' => 1, 'product_id' => 1, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 2, 'product_id' => 1, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 3, 'product_id' => 2, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 4, 'product_id' => 2, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 5, 'product_id' => 3, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 6, 'product_id' => 3, 'subcategory_id' => 1, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],

            ['id' => 7, 'product_id' => 4, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 8, 'product_id' => 4, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 9, 'product_id' => 5, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 10, 'product_id' => 5, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 11, 'product_id' => 6, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 12, 'product_id' => 6, 'subcategory_id' => 2, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],

            ['id' => 13, 'product_id' => 7, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 14, 'product_id' => 7, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 15, 'product_id' => 8, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 16, 'product_id' => 8, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 17, 'product_id' => 9, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 18, 'product_id' => 9, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 19, 'product_id' => 10, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 20, 'product_id' => 10, 'subcategory_id' => 3, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],

            ['id' => 21, 'product_id' => 11, 'subcategory_id' => 4, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 22, 'product_id' => 12, 'subcategory_id' => 4, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 23, 'product_id' => 13, 'subcategory_id' => 4, 'category_id' => 1, 'group_id' => 2, 'created_at' => Carbon::now()],

            ['id' => 24, 'product_id' => 14, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 25, 'product_id' => 14, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 26, 'product_id' => 15, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 27, 'product_id' => 15, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 2, 'created_at' => Carbon::now()],
            ['id' => 28, 'product_id' => 16, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 1, 'created_at' => Carbon::now()],
            ['id' => 29, 'product_id' => 16, 'subcategory_id' => 5, 'category_id' => 2, 'group_id' => 2, 'created_at' => Carbon::now()],
        ]);
    }
}
