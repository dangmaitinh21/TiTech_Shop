<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\cartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(cartService $cart)
    {
        $this->cart = $cart;
    }

    public function index() {
        return view('adminPage.cart.customer', [
            'title' => 'List Orders',
            'customer' => $this->cart->getCustomer()
        ]);
    }
}
