<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\cartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cart;
    public function __construct(cartService $cart)
    {
        $this->cart = $cart;        
    }

    public function index(Request $request) {
        $result = $this->cart->createCart($request);
        if($result === false) {
            return redirect()->back();
        }
        return redirect('/carts');
    }

    public function show() {
        $products = $this->cart->getProducts();
        return view('carts.list', [
            'title' => 'Carts',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request) {
        $this->cart->updateCart($request);
        return redirect()->back();
    }
}
