<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'phone' => '02437347941',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 0,
                'address' => 'So 23 Ta Quang Buu, Bach Khoa, Hai Ba Trung, Ha Noi',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Ponleuly',
                'phone' => '02437347942',
                'email' => 'lyponleu116@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => 'Tang 10, 24 Hoang Quoc Viet, Nghia Do, Quan Cau Giay, Ha Noi',
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'User1',
                'phone' => '02437347943',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => 'So 23 Ta Quang Buu, Bach Khoa, Hai Ba Trung, Ha Noi',
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'User2',
                'phone' => '02437347944',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => 'Tang 10, 24 Hoang Quoc Viet, Nghia Do, Quan Cau Giay, Ha Noi',
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'User3',
                'phone' => '02437347945',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => 'So 23 Ta Quang Buu, Bach Khoa, Hai Ba Trung, Ha Noi',
                'role' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'id' => 6,
                'name' => 'User4',
                'phone' => '02437347946',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => 'Tang 10, 24 Hoang Quoc Viet, Nghia Do, Quan Cau Giay, Ha Noi',
                'role' => 1,
                'created_at' => Carbon::now(),
            ],

        ]);

        for ($i = 1; $i <= 50; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'email' => Str::random(10) . '@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => fake()->address(),
                'role' => 1,
                'created_at' => Carbon::now(),
                //'customer_id ' => Str::random(10) . '@gmail.com',
                //'email' => fake()->unique()->safeEmail(),

            ]);
        }
    }
}
