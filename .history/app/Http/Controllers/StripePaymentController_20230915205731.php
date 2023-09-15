<?php

namespace App\Http\Controllers;

use App\Models\Bill;
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
        $products = Product::select('id', 'name', 'price', 'price_sale')
                    ->where('active', 1)
                    ->whereIn('id', $productId)
                    ->get();

        $data = [];
        foreach($products as $key => $product) {
            $data[] = (object) [
                'name' => $product->name,
                'price' => $product->price_sale ? $product->price_sale : $product->price,
                'quantity' => $request->input('num-product')[$product->id],
            ];
        }
        $information = (object)[
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'note' => $request->input('note'),
            'price' => $request->input('price')
        ];

        return view('checkout', [
            'title' => 'Checkout',
            'products' => $data,
            'information' => $information,
        ]);
    }

    public function payment(Request $request)
    {
        //Stripe::setApiKey(config('services.stripe.secret'));
        try {
            // Charge::create([
            //     'amount' => $request->input('price') * 100, 
            //     'currency' => 'usd', 
            //     'source' => $request->stripeToken,
            // ]);
            
            Bill::create([
                'customer_id' => (int) $request->input('customer_id'),
                'price' => (float) $request->input('price'),
            ]);

            Session::flash('success', 'Thanh toán thành công');
            //return view('carts.success', ['title' => 'Payment success']);
            return redirect()->back();
        } catch(\Exception $err) {
            Log::info($err->getMessage());
            Session::flash('error', $err);
            return redirect()->back();
        }
    }
}
