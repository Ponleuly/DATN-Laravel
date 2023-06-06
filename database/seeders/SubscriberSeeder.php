<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('subscribers')->insert([
                's_name' => fake()->firstName() . ' ' . fake()->lastName(),
                's_email' => fake()->unique()->safeEmail(),
                'created_at' => Carbon::now()

                //'customer_id ' => Str::random(10) . '@gmail.com',
            ]);
        }
    }
}
