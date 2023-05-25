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
                'status_color' => '#ffc107',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'status' => 'Processing',
                'status_color' => '#0d6efd',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'status' => 'Delivered',
                'status_color' => '#198754',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'status' => 'Canceled',
                'status_color' => '#dc3545',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
