<?php

namespace App\Http\Controllers\PaymentController;

use Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    //
    public function stripe()
    {
        return view('frontend.mainPages.stripe');
    }
    public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => ($request->amount) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "15steps"
        ]);

        return redirect()->back()->with('success', 'Payment successful!');
        //return dd($request->toArray());
    }
}
