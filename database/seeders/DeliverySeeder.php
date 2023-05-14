<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            [
                'id' => 1,
                'delivery_option' => "Fast Delivery 1 - 2 days",
                'delivery_fee' => 4.00,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'delivery_option' => "Standard 3 - 5 days",
                'delivery_fee' => 2.00,
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
