<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\createFormProduct;
use App\Http\Services\Products\productsService;
use App\Http\Services\Categories\categoriesService;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $this->productsService->createProduct($request);
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
        // $this->productsService->updateProduct($product, $request);
        dd($request->input());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
