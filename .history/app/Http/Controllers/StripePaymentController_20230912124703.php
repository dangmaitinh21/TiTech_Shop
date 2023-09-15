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
        Stripe::setApiKey(config('services.stripe.secret'));
        dd((float) $request->input('price'));
        // try {
        //     Charge::create([
        //         'amount' => (float) $request->input('price'), 
        //         'currency' => 'usd', 
        //         'source' => $request->stripeToken,
        //     ]);
        //     Session::flash('success', 'Thanh toán thành công');
        //     return redirect('/checkout');
        // } catch(\Exception $err) {
        //     Log::info($err->getMessage());
        //     Session::flash('error', $err);
        //     return redirect('/checkout');
        // }
    }
}
