<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\Orders_Details;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class totalPaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Orders::orderBy('id')->get();

        foreach ($orders as $order) {
            $totalAmount = 0;
            $total = 0;
            $deliveryFee = $order->delivery_fee;
            $discount = $order->discount;
            $orderDetails = Orders_Details::where('order_id', $order->id)->get();
            foreach ($orderDetails as  $orderDetail) {
                $price = $orderDetail->product_price;
                $qty = $orderDetail->product_quantity;
                $totalAmount += $price * $qty;
            }
            $total = $totalAmount + $deliveryFee - $discount;
            DB::table('orders')->where('id', $order->id)->update([
                'total_paid' => $total,
            ]);
        }
    }
}
