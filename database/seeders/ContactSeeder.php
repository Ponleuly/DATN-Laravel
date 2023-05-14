<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'id' => 1,
                'contact_info' => 'Tel: 084 3124 150',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'contact_info' => 'Email: 15steps@gmail.com',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'contact_info' => 'Facebook: 15Steps Store',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
