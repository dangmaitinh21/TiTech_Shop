<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Categories\categoriesService;

class CategoryController extends Controller
{
    protected $categories;
    public function __construct(categoriesService $categories)
    {
        $this->categories = $categories;
    }

    public function index(Request $request, $id, $slug = '') {
        $category = $this->categories->getId($id);
        $products = $this->categories->getProducts($category, $request);
        return view('category', [
            'title' => $category->name,
            'category' => $category,
            'products' => $products
        ]);
    }
}
