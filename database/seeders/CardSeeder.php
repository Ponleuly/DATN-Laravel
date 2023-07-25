<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Orders;
use App\Models\Customers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Orders::where('payment_method', 'Credit Card')->get();
        foreach ($orders as $order) {
            $customer = Customers::where('order_id', $order->id)->first();
            DB::table('cards')->insert([
                'order_id' => $order->id,
                'card_digit' => substr(fake()->creditCardNumber(), -4),
                'card_brand' => fake()->creditCardType(),
                'holder_name' => strtoupper($customer->c_name),
                'holder_email' => $customer->c_email,
                'order_code' =>  $order->invoice_code,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
