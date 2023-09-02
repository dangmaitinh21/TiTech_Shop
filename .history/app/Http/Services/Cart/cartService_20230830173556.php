<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class cartService {
    public function createCart($request) {
        $quantity = (int) $request->input('num-product');
        $productId = (int) $request->input('productId');

        if($quantity <= 0 || $productId <= 0) {
            Session::flash('error', 'The quantity or product has something wrong');
            return false;
        }
        $carts = Session::get('carts');
        if(is_null($carts)) {
            Session::put('carts', [
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
        if(Arr::exists($carts, $productId)) {
            Session::put('carts', [
                ...$carts,
                'quantity' => $carts['quantity'] + $quantity
            ]);
        } else {
            Session::put('carts', [
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
        dd($carts['quantity']);
    } 
}