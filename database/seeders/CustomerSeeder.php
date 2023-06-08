<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Customers::factory()->count(50)->create();
        for ($i = 1; $i <= 50; $i++) {
            DB::table('customers')->insert([
                'c_name' => fake()->firstName() . ' ' . fake()->lastName(),
                'c_phone' => fake()->phoneNumber(),
                'c_email' => fake()->unique()->safeEmail(),
                'c_address' => fake()->streetAddress(),
                'c_city' => fake()->city(),
                'c_district' => fake()->stateAbbr(),
                'c_ward' => fake()->state(),
                'c_note' => fake()->realText($maxNbChars = 50, $indexSize = 2),
                'order_id' => $i,
                'created_at' => Carbon::now()

                //'customer_id ' => Str::random(10) . '@gmail.com',
            ]);
        }
    }
}
