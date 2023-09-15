<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\cartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;

class CartController extends Controller
{
    protected $cart;
    public function __construct(cartService $cart)
    {
        $this->cart = $cart;        
    }

    public function addProduct(Request $request) {
        $result = $this->cart->createCart($request);
        if($result === false) {
            session(['addToCart' => 'fail']);
        } else {
            session(['addToCart' => 'success']);
        }
        return redirect()->back();
    }

    public function show() {
        $products = $this->cart->getProducts();
        return view('carts.list', [
            'title' => 'Carts',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function updateCart(Request $request) {
        $this->cart->updateCart($request);
        return redirect()->back();
    }

    public function deleteProduct($id = 0) {
        $this->cart->deletePFCart($id);
        return redirect()->back();
    }

    public function addCart(Request $request) {
        $result = $this->cart->addCart($request);
        if($result) {
            return view('carts.success', [
                'title' => 'Order Success'
            ]);
        }
        return redirect()->back();
    }

    public function payment(Request $request) {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            Charge::create([
                'amount' => $request->input('price') * 100, //cent currency
                'currency' => 'usd', 
                'source' => $request->stripeToken,
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
