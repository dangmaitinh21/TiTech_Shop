<?php

namespace App\Http\Controllers;

use App\Http\Services\Products\productsService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $products;

    public function __construct(productsService $products)
    {
        $this->products = $products;
    }

    public function index($id = '', $slug = '') {
        $product = $this->products->showId($id);
        return view('product.detail', [
            'title' => $product->name,
            'product' => $product
        ]);
    }
}
