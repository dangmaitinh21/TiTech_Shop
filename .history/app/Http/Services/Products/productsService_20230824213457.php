<?php
namespace App\Http\Services\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class productsService {

    protected function isValidPrice($request) {
        if((float) $request->input('productPrice') !== 0  && (float) $request->input('productPriceSale') !== 0 && (float) $request->input('productPrice') <= (float) $request->input('productPriceSale')) {
            Session::flash('error', 'Price sale must be less than price origin of product');
            return false;
        }

        if((float) $request->input('productPriceSale') !== 0 && (float) $request->input('productPrice') === 0) {
            Session::flash('error', 'Price origin is required');
            return false;
        }
        return true;
    }

    public function createProduct($request) {
        if(!($this->isValidPrice($request))) return false;
        try {
            //Except field token in request
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

    public function getProducts() {
        return Product::with('category')
        ->orderbyDesc('id')->paginate(15);
    }

    public function updateProduct($product, $request) {
        if(!($this->isValidPrice($request))) return false;
        try {
            $product->name = (string) $request->input('productName');
            $product->category_id = (int) $request->input('productCategory');
            $product->image = (string) $request->input('productImage');
            $product->description = (string) $request->input('productDescription');
            $product->content = (string) $request->input('productDetail');
            $product->price = (float) $request->input('productPrice');
            $product->price_sale = (float) $request->input('productPriceSale');
            $product->active = (boolean) $request->input('productActive');
            $product->save();
            Session::flash('success', 'Successfully update product ' . $product->name);
            return true;
        } catch(\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function delProduct($request) {
        $id=$request->input('id');
        $isExist=Product::where('id', $id)->first();
        if($isExist) {
            return Product::where('id', $id)->delete();
        }
        return false;
    }
}