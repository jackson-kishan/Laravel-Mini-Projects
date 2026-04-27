<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('payments.stripe-payment');
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create([
            'amount' => 10 * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Test payment',
         ]);

         return back()->with('success', 'Payment Successful');
    }
}
