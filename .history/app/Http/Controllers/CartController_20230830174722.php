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
        $this->cart->createCart($request);
        dd(Session::get('carts'));
    }
}
