<?php

namespace App\Http\Controllers\PaymentController;

use Stripe;
use App\Models\test;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\Orders_Details;
use App\Http\Controllers\Controller;
use App\Models\Cards;
use PhpParser\Node\Stmt\TryCatch;

class StripeController extends Controller
{
    // Payment
    public function paymentForm($invoiceCode, $totalPaid)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        //============= Get product order =======================//
        $order = Orders::where('invoice_code', '#' . $invoiceCode)->first();
        $orderId = $order->id;
        $orderDetails = Orders_Details::where('order_id', $orderId)->get();
        $lineItems = [];

        //==== Get order detail from DB
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

        //==== Store payment to Stripe Platform
        $checkout_session = $stripe->checkout->sessions->create([
            'payment_intent_data' => [
                'description' => 'Order invoice code #' . $invoiceCode
            ],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Total Paid',
                        ],
                        'unit_amount' => intval($totalPaid * 100),
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            //'success_url' => 'http://127.0.0.1:8000/order-completed/invoice=' . $invoiceCode . '/success?session_id={CHECKOUT_SESSION_ID}',
            'success_url' => 'http://127.0.0.1:8000/order-completed/invoice=' . $invoiceCode,
            'cancel_url' => 'http://127.0.0.1:8000/order-canceled/invoice=' . $invoiceCode,
            'expires_at' => time() + (1800), // Configured to expire after 2 hours
        ]);
        return redirect($checkout_session->url);
    }


    //==== Store payment detail from Stripe to Card DB
    public function paymentInfo(Request $request)
    {
        if ($request->type === 'charge.succeeded') {
            try {
                $invoiceCode = trim($request->data['object']['description'], 'Order invoice code ');
                $order = Orders::where('invoice_code', $invoiceCode)->first();
                $orderId = $order->id;
                Cards::create([
                    'order_id' => $orderId,
                    'payment_id' => $request->data['object']['payment_method'],
                    'card_digit' => $request->data['object']['payment_method_details']['card']['last4'],
                    'card_brand' => $request->data['object']['payment_method_details']['card']['brand'],
                    'holder_name' => strtoupper($request->data['object']['billing_details']['name']),
                    'holder_email' => $request->data['object']['billing_details']['email'],
                    'holder_phone' => $request->data['object']['billing_details']['phone'],
                    'order_code' => trim($request->data['object']['description'], 'Order invoice code '),
                    'payment_status' => $request->type,
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        if ($request->type === 'charge.refunded') {
            try {
                $card = Cards::where('order_code', trim($request->data['object']['description'], 'Order invoice code '))->first();
                $card->payment_status = $request->type;
                $card->update();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }


    // public function payment(Request $request, $invoiceCode, $totalPaid)
        // {

        //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //     Stripe\Charge::create([
        //         "amount" => ($totalPaid) * 100,
        //         "currency" => "usd",
        //         "source" => $request->stripeToken,
        //         "description" => "Order inovice code #" . $invoiceCode,
        //     ]);

        //     return redirect('order-completed/invoice=' . $invoiceCode)->with('success', 'Payment successful!');

        //     //return dd($request->toArray());
    // }
}
