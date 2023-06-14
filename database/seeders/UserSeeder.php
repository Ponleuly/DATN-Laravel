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
                'profile_img' => 'admin.jpg',
                'name' => 'Admin',
                'phone' => '02437347941',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 0,
                'address' => ucwords('42 LE THAI TO'),
                'city' => ucwords('Ha NOI'),
                'district' => ucwords('HOAN KIEM'),
                'ward' => ucwords('HANG TRONG'),

                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'profile_img' => 'admin.jpg',
                'name' => 'Ponleuly',
                'phone' => '02437347942',
                'email' => 'lyponleu116@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ucwords('97 HAO NAM'),
                'city' => ucwords('HA NOI'),
                'district' => ucwords('DONG DA'),
                'ward' => ucwords('P.O CHO DUA'),
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'profile_img' => 'admin.jpg',
                'name' => 'User1',
                'phone' => '02437347943',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ucwords('24B LO DUC'),
                'city' => ucwords('HA NOI'),
                'district' => ucwords('HAI BA TRUNG'),
                'ward' => ucwords('PHAM DINH HO'),
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'profile_img' => 'admin.jpg',
                'name' => 'User2',
                'phone' => '02437347944',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ucwords('26 TUE TINH'),
                'city' => ucwords('HA NOI'),
                'district' => ucwords('HAI BA TRUNG'),
                'ward' => ucwords(' BUI THI XUAN'),
                'role' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'profile_img' => 'admin.jpg',
                'name' => 'User3',
                'phone' => '02437347945',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ucwords('8C HOANG NGOC PHACH'),
                'city' => ucwords('HA NOI'),
                'district' => ucwords('DONG DA'),
                'ward' => ucwords('LANG HA'),
                'role' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'id' => 6,
                'profile_img' => 'admin.jpg',
                'name' => 'User4',
                'phone' => '02437347946',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ucwords('30 HANG BONG'),
                'city' => ucwords('HA NOI'),
                'district' => ucwords('HOAN KIEM'),
                'ward' => ucwords('HANG GAI'),
                'role' => 1,
                'created_at' => Carbon::now(),
            ],

        ]);

        for ($i = 1; $i <= 50; $i++) {
            DB::table('users')->insert([
                'profile_img' => '',
                'name' => fake()->firstName() . ' ' . fake()->lastName(),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('12345678'),
                'address' => fake()->streetAddress(),
                'city' => fake()->city(),
                'district' => fake()->stateAbbr(),
                'ward' => fake()->state(),
                'role' => 1,
                'created_at' => Carbon::now(),
                //'customer_id ' => Str::random(10) . '@gmail.com',
                //'email' => fake()->unique()->safeEmail(),

            ]);
        }
    }
}
