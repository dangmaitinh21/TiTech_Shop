<?php

namespace App\Http\Services\Cart;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        $exists = Arr::exists($carts, $productId);
        if($exists) {
           $carts[$productId] = $carts[$productId] + $quantity;
           Session::put('carts', $carts);
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

    public function updateCart($request) {
        Session::put('carts', $request->input('num-product'));
        return true;
    }

    public function deletePFCart($id) {
        $carts = Session::get('carts');
        $exists = Arr::exists($carts, $id);
        if(!$exists) return false;
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request) {
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if(is_null($carts)) return false;
            $customer = Customer::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'note' => $request->input('note')
            ]);
            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            Session::flash('success', 'Your order has been confirmed');

            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
            return true;
        } catch(\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Sorry, payment failed');
            Log::info($err);
            return false;
        }
    }

    protected function infoProductCart($carts, $customer_id) {
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'image')
                    ->where('active', 1)
                    ->whereIn('id', $productId)
                    ->get();
        $data = [];
        foreach($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id],
                'price' => $product->price_sale ? $product->price_sale : $product->price,
            ];
        }
        return Cart::insert($data);
    }
}