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
        try {
            Charge::create([
                'amount' => $request->input('price'), // Số tiền thanh toán (ở đây là 1000 đơn vị tiền tệ, ví dụ: 10 USD)
                'currency' => 'usd', // Đơn vị tiền tệ
                'source' => $request->stripeToken, // Token Stripe từ biểu mẫu
            ]);
            Session::flash('success', 'Thanh toán thành công');
            return redirect('/checkout');
        } catch(\Exception $err) {
            Log::info($err->getMessage());
            Session::flash('error', $err);
            return redirect('/checkout');
        }
    }
}
