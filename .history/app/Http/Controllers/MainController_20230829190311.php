<?php

namespace App\Http\Controllers;

use App\Http\Services\Categories\categoriesService;
use App\Http\Services\Products\productsService;
use App\Http\Services\Sliders\slidersService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $sliders, $categories, $products;
    public function __construct(slidersService $sliders, categoriesService $categories, productsService $products)
    {
        $this->sliders = $sliders;
        $this->categories = $categories;
        $this->products = $products;
    }

    public function index() {
        return view('home', [
            'title' => 'The world of Cars',
            'sliders' => $this->sliders->show(),
            'categories' => $this->categories->show(),
            'products' => $this->products->show(),
        ]);
    }

    public function loadMoreProducts(Request $request) {
        $page = $request->input('page', 0);
        $result = $this->products->show($page);
        if($result->count() > 0) {
            $html = view('products.list', ['products' => $result])->render();
            return response()->json([
                'html' => $html,
                'canLoadMore' => $result->count() < $this->products::LIMIT ? false : true
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }
}
