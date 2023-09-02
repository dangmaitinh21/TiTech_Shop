<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\cartService;
use App\Models\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(cartService $cart)
    {
        $this->cart = $cart;
    }

    public function index() {
        return view('adminPage.carts.customers', [
            'title' => 'List Customers',
            'customers' => $this->cart->getCustomers()
        ]);
    }

    public function getOrders(Customer $customer) {
        $carts = $this->cart->getProductForCart($customer);
        return view('adminPage.carts.detail', [
            'title' => 'Order of ' . $customer->name,
            'customer' => $customer,
            'carts' => $carts
        ]);
    }
}
