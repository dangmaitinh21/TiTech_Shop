<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\createFormCategory;
use App\Http\Services\Categories\categoriesService;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categoriesService;

    public function __construct(categoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function renderFormCategory() {
        return view('adminPage.categories.add', [
            'title'=>'Add Category',
            'categories'=>$this->categoriesService->getParent(),
        ]);
    }

    public function createCategory(createFormCategory $request) {
        $this->categoriesService->createCategory($request);
        return redirect()->back();
    }

    public function getCategories() {
        return view('adminPage.categories.list', [
            'title' => 'List Category',
            'categories' => $this->categoriesService->getCategories(),
        ]);
    }

    public function delCategory(Request $request) {
        $result = $this->categoriesService->delCategory($request);
        if($result) {
            return response()->json([
                'error'=>false,
                'message'=>'Delete category successfully'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Delete category failed!!!'
        ]);
    }

    public function updateCategory(Categories $category, createFormCategory $request) {
        $result = $this->categoriesService->updateCategory($request, $category);
        if($result) {
            return redirect('/admin/categories/list');
        }
        return response()->json([
            'error'=>true,
            'message'=>'Update category failed!!!'
        ]);
    }

    public function editFormCategory(Categories $category) {
        $categories = $this->categoriesService->getCategories();
        echo ($categories);
        return view('adminPage.categories.edit', [
            'title'=>'Edit category ' . $category->name,
            'category'=>$category,
            'categories' => $categories,
        ]);
    }
}
