<?php

namespace App\Http\Controllers\PaymentController;

use Stripe;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\Orders_Details;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    //
    public function paymentForm($invoiceCode, $totalPaid)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        //============= Get product order =======================//
        $order = Orders::where('invoice_code', '#' . $invoiceCode)->first();
        $orderId = $order->id;
        $orderDetails = Orders_Details::where('order_id', $orderId)->get();
        $lineItems = [];
        foreach ($orderDetails as $orderInfo) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $orderInfo->rela_product_order->product_name,
                        'images' => [$orderInfo->rela_product_order->product_imgcover],
                    ],
                    'unit_amount' => intval($orderInfo->product_price * 100),
                ],
                'quantity' => $orderInfo->product_quantity,

            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'shipping_options' => [
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => $order->delivery_fee * 100,
                            'currency' => 'usd',
                        ],
                        'display_name' => 'Shopping Charge with Discount Coupon',
                    ],
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/home',
            'cancel_url' => 'http://localhost:4242/cancel',
        ]);

        return redirect($checkout_session->url);
        /*
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
        */
        //return dd($orderDetails);

    }
    public function payment(Request $request, $invoiceCode, $totalPaid)
    {
        /*
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => ($totalPaid) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Order inovice code #" . $invoiceCode,
        ]);

        return redirect('order-completed/invoice=' . $invoiceCode)->with('success', 'Payment successful!');
        */
        return dd($request->toArray());
    }
}
