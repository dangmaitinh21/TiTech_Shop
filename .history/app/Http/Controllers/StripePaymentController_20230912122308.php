<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    public function test() {
        return view('checkout');
    }

    public function payment(Request $request)
    {
        try {
            $stripe = new Stripe(env('STRIPE_SECRET'));
            $charge = Charge::create(array(
                'amount' => $request->input('price'),
                'currency' => 'usd',
                'description' => 'Payment for your product',
                'source' => $request->stripeToken
                ));
            return redirect('/');
        } catch(\Exception $err) {
            Log::info($err->getMessage());
            Session::flash('error', $err);
            return redirect('/checkout');
        }
    }
}
