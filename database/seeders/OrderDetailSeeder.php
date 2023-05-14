<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('orders_details')->insert([
                'order_id' => $i,
                'product_id' => rand(1, 16),
                'product_price' => floatval(rand(22, 25)),
                'product_quantity' => rand(1, 2),
                'size_id' => rand(1, 12),
                'created_at' => Carbon::now()

                //'customer_id ' => Str::random(10) . '@gmail.com',
            ]);
            if ($i % 4 == 0) {
                DB::table('orders_details')->insert([
                    'order_id' => $i,
                    'product_id' => rand(1, 16),
                    'product_price' => floatval(rand(22, 25)),
                    'product_quantity' => rand(1, 2),
                    'size_id' => rand(1, 12),
                    'created_at' => Carbon::now()

                    //'customer_id ' => Str::random(10) . '@gmail.com',
                ]);
            }
        }
    }
}
