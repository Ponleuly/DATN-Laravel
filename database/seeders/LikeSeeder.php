<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            [
                'id' => 1,
                'product_id' => 2,
                'user_id' => 2,

                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'product_id' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'product_id' => 13,
                'user_id' => 5,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'product_id' => 8,
                'user_id' => 5,
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
