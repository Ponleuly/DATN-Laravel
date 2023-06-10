<?php

namespace Database\Seeders;

use App\Models\Products;
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
            $pro_id = rand(1, 16);
            if ($pro_id == 14 || $pro_id == 15 || $pro_id == 16) {
                $size_id = 13;
            } else {
                $size_id = rand(1, 12);
            }
            $product = Products::where('id', $pro_id)->first();
            DB::table('orders_details')->insert([
                'order_id' => $i,
                'product_id' => $pro_id,
                'product_price' => floatval($product->product_saleprice),
                'product_quantity' => rand(1, 2),
                'size_id' => $size_id,
                'created_at' => Carbon::now()

                //'customer_id ' => Str::random(10) . '@gmail.com',
            ]);
            if ($i % 4 == 0) {
                $proId = rand(1, 13);
                $product = Products::where('id', $proId)->first();

                DB::table('orders_details')->insert([
                    'order_id' => $i,
                    'product_id' => $proId,
                    'product_price' => floatval($product->product_saleprice),
                    'product_quantity' => rand(1, 2),
                    'size_id' => rand(1, 12),
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }
}
