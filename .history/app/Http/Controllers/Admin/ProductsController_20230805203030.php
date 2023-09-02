<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Products\productsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productsService;
    
    public function __construct(productsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function renderFormProduct() {
        return view('adminPage.products.add', [
            'title'=>'Add Product',
        ]);
    }

    public function createProduct(Request $request) {
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
