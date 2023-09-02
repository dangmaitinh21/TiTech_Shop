<?php
namespace App\Http\Services\Products;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;

class productsService {
    public function createProduct($request) {
        try {
            Product::create([
                'name' => (string) $request->input('productName'),
                'image' => (int) $request->input('productImage'),
                'description' => (string) $request->input('productDescription'),
                'content' => (string) $request->input('productDetail'),
                'category_id' => (int) $request->input('categoryOfProduct'),
                'price' => (int) $request->input('productPrice'),
                'price_sale' => (int) $request->input('productPriceSale'),
                'active' => (boolean) $request->input('productActive'),
            ]);
            Session::flash('success', 'Create product successfully');
            return true;
        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        };
    }
}