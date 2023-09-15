<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    public function checkout(Request $request) {
        $productId = array_keys($request->input('num-product'));
        $products = Product::select('name', 'price')
                    ->where('active', 1)
                    ->whereIn('id', $productId)
                    ->get();

        return view('checkout', [
            'title' => 'Bills',
            'products' => $products,
            ''
        ]);
    }

    public function payment(Request $request)
    {
        
        
        // Stripe::setApiKey(config('services.stripe.secret'));
        // try {
        //     Charge::create([
        //         'amount' => $request->input('price') * 100, 
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
