<?php

namespace App\Http\Controllers\PaymentController;

use Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    //
    public function paymentForm($invoiceCode, $totalPaid)
    {
        return view('frontend.mainPages.payment_form', compact('totalPaid', 'invoiceCode'));
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
