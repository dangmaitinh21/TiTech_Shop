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
        try {
            $request->except('_token');
            Product::create([
                'name' => (string) $request->input('productName'),
                'image' => (string) $request->input('productImage'),
                'description' => (string) $request->input('productDescription'),
                'content' => (string) $request->input('productDetail'),
                'category_id' => (int) $request->input('categoryOfProduct'),
                'price' => (float) $request->input('productPrice'),
                'price_sale' => (float) $request->input('productPriceSale'),
                'active' => (boolean) $request->input('productActive'),
            ]);
            Session::flash('success', 'Create product successfully');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Failed to create product');
            Log::info($err->getMessage());
            return false;
        };
    }
}