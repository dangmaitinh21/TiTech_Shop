<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\createFormProduct;
use App\Http\Services\Products\productsService;
use App\Http\Services\Categories\categoriesService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    protected $productsService;
    
    public function __construct(productsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function renderFormProduct() {
        $categories = new categoriesService;
        return view('adminPage.products.add', [
            'title'=>'Add Product',
            'categories'=> $categories->getCategories(),
        ]);
    }

    public function createProduct(createFormProduct $request) {
        $result = $this->productsService->createProduct($request);
        if($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    public function getProducts() {
        return view('adminPage.products.list', [
            'title'=>'List Products',
            'products'=> $this->productsService->getProducts()
        ]); 
    }

    public function editFormProduct(Product $product) {
        $categories = new categoriesService;
        return view('adminPage.products.edit', [
            'title' => 'Edit Product',
            'categories'=> $categories->getCategories(),
            'product' => $product
        ]);
    }

    public function updateProduct(Product $product, Request $request) {
        $result = $this->productsService->updateProduct($product, $request);
        if($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }
    
    public function delProduct(Request $request) {
        $result = $this->productsService->delProduct($request);
        if($result) {
            return response()->json([
                'error'=>false,
                'message'=>'Successfully delete product'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Failed delete product'
        ]);
    }
}
