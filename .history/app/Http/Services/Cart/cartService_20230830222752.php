<?php

namespace App\Http\Services\Cart;

use App\Models\Product;
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
                $productId => $quantity
            ]);
            return true;
        }
        if(Arr::exists($carts, $productId)) {
           $carts[$productId] = $carts[$productId] + $quantity;
           Session::put('carts', $carts);
           dd($carts[$productId]);
           return true;
        } 
        $carts[$productId] = $quantity;
        Session::put('carts', $carts);
        return true;
    } 

    public function getProducts() {
        $carts = Session::get('carts');
        if(is_null($carts)) return [];
        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'image')
        ->where('active', 1)
        ->whereIn('id', $productId)
        ->get();
    }
}