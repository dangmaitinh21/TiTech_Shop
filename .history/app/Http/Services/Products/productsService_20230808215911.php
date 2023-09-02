<?php
namespace App\Http\Services\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class productsService {

    protected function isValidPrice($request) {
        if($request->input('productPrice') !== 0  && $request->input('productPriceSale') && $request->input('productPrice' <= $request->input('productPriceSale')) ) {
            Session::flash('error', 'Price sale must be less than price origin of product');
            return false;
        }

        if($request->input('productPriceSale') !== 0 && (int) $request->input('productPrice') === 0) {
            Session::flash('error', 'Price origin is required');
            return false;
        }
        return true;
    }

    public function createProduct($request) {
        if(!($this->isValidPrice($request))) return false;
        dd($request->input());
    }
}