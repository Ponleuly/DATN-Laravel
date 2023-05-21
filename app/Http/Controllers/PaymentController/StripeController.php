<?php

namespace App\Http\Controllers\PaymentController;

use Stripe;
use App\Models\Orders;
use App\Models\Orders_Details;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    //
    public function paymentForm($invoiceCode, $totalPaid)
    {
        //=============== Get data to display on user invoice =======================S//
        $order = Orders::where('invoice_code', '#' . $invoiceCode)->first();
        $orderId = $order->id;
        $discount = $order->discount;
        $deliveryFee = $order->delivery_fee;
        $orderDetails = Orders_Details::where('order_id', $orderId)->get();
        $amount = 0;
        foreach ($orderDetails as $product) {
            $amount += $product->product_price * $product->product_quantity;
        }
        return view(
            'frontend.mainPages.payment_form',
            compact(
                'totalPaid',
                'invoiceCode',
                'discount',
                'deliveryFee',
                'amount'

            )
        );
        //return dd($orderDetails);
    }
    public function payment(Request $request, $invoiceCode, $totalPaid)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => ($totalPaid) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Order inovice code #" . $invoiceCode,
        ]);

        return redirect()->back()->with('success', 'Payment successful!');

        //return dd($request->toArray());
    }
}
