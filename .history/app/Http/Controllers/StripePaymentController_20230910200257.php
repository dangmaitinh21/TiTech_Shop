<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $stripe = new Stripe(env('STRIPE_SECRET'));

        $stripe->charges()->create([
            'amount' => 1000, // Số tiền cần thanh toán (đơn vị là cent)
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment for your product',
        ]);

        return 'Payment successful!';
    }
}
