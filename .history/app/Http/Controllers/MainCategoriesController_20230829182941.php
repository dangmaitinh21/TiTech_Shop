<?php

namespace App\Http\Controllers;

use App\Http\Services\Categories\categoriesService;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    protected $categories;
    public function __construct(categoriesService $categories)
    {
        $this->categories = $categories;
    }

    public function index(Request $request, $id, $slug = '') {
        $category = $this->categories->getId($id);
        $products = $this->categories->getProducts($category);
        return view('category', [
            'title' => $category->name,
            'category' => $category,
            'products' => $products
        ]);
    }
}
