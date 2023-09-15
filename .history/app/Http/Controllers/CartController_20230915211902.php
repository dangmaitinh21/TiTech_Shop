<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\cartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $products = $this->cart->getProductsCheckout($request->input('num-product'));
        $information = (object)[
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'note' => $request->input('note'),
            'price' => $request->input('price')
        ];
        if($result) {
            return view('checkout', [
                'title' => 'Checkout',
                'user' => Auth::user(),
                'information' => $information,
                'products' => $products
            ]);
        }
        return redirect()->back();
    }
}
