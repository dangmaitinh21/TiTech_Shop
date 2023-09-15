<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\cartService;
use App\Models\Bill;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    protected $cartService;
    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function payment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            Charge::create([
                'amount' => $request->input('price') * 100, 
                'currency' => 'usd', 
                'source' => $request->stripeToken,
            ]);
            
            Bill::create([
                'customer_id' => (int) $request->input('customer_id'),
                'price' => (float) $request->input('price'),
                'isPayment' => true
            ]);
            Session::forget('carts');
            Session::flash('success', 'Payment success');
            return view('carts.success', ['title' => 'Payment success']);
            return redirect()->back();
        } catch(\Exception $err) {
            Log::info($err->getMessage());
            Session::flash('error', $err);
            return redirect()->back();
        }
    }
}
