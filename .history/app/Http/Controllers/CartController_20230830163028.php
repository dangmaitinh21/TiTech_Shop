<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\cartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(cartService $cart)
    {
        $this->cart = $cart;        
    }

    public function index(Request $request) {
        $result = $this->cart->createCart($request);
    }
}
