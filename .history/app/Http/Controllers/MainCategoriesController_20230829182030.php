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

    public function index(Request $request, $id, $slug) {
        $result = $this->categories->getListWithId($id);
    }
}
