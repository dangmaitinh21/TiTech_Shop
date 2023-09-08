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

    public function addProduct(Request $request) {
        $result = $this->cart->createCart($request);
        if($result === false) {
            Session::flash('error', 'Unable to add product to cart');
        } else {
            Session::flash('success', 'Product added to cart successfully');
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
}
