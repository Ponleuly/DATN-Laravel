<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders_statuses')->insert([
            [
                'id' => 1,
                'status' => 'Pending',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'status' => 'Processing',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'status' => 'Delivered',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'status' => 'Canceled',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
