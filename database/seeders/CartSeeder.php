<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'product_id' => 1,
                'size_id' => 7,
                'product_quantity' => 1,
                'product_price' => 20.00,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'product_id' => 12,
                'size_id' => 12,
                'product_quantity' => 1,
                'product_price' => 35.00,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'product_id' => 9,
                'size_id' => 8,
                'product_quantity' => 1,
                'product_price' => 25.00,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'product_id' => 13,
                'size_id' => 12,
                'product_quantity' => 1,
                'product_price' => 35.00,
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
