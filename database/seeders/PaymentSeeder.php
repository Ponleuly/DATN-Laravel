<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'payment_title' => "Cash",
                'payment_detail' => "Pay money after get product.",
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'payment_title' => "Bank Transfer",
                'payment_detail' => 
                    "<p>Customer please transfer to bank acount below :</p>
                        <ul>
                            <li>Bank: <strong>Agribank</strong></li>
                            <li>Account: <strong>1303206422785</strong></li>
                            <li>Account's name: <strong>LY PONLEU</strong></li>
                            <li>Remark: <strong>Customer's name + Orders code</strong></li>
                        </ul>",
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
