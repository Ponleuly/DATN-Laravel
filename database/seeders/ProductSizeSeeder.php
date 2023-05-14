<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $j = 1;
        $k = 1;
        for ($i = 1; $i <= 156; $i++) {
            DB::table('products_sizes')->insert([
                [
                    'id' => $i,
                    'product_id' => $j,
                    'size_id' => $k++,
                    'size_quantity' => 10,
                    'created_at' => Carbon::now()
                ],
            ]);

            if ($i == $j * 12) $j++;
            if ($k == 13) $k = 1;
        }
        //==== For Hat product free size ====//
        DB::table('products_sizes')->insert([
            [
                'id' => 157,
                'product_id' => 14,
                'size_id' => 13,
                'size_quantity' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 158,
                'product_id' => 15,
                'size_id' => 13,
                'size_quantity' => 10,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 159,
                'product_id' => 16,
                'size_id' => 13,
                'size_quantity' => 10,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
