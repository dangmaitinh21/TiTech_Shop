<?php

namespace App\Http\Services\Categories;

use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class categoriesService {
    public function createCategory($request) {
        try {
            Categories::create([
                'name' => (string) $request->input('categoryName'),
                'parent_id' => (int) $request->input('parentCategory'),
                'description' => (string) $request->input('categoryDescription'),
                'content' => (string) $request->input('categoryDetail'),
                'active' => (boolean) $request->input('categoryActive'),
            ]);
            Session::flash('success', 'Create category successfully');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Failed create new category');
            Log::info($err->getMessage());
            return false;
        };
    }

    public function show() {
        return Categories::select('id', 'name')->where('parent_id', 0)->orderbyDesc('id')->get();
    }

    public function getParent() {
        return Categories::where('parent_id', 0)->get();
    }

    public function getCategories() {
        return Categories::orderbyDesc('id')->paginate(10);
    }

    public function updateCategory($request, $category) : bool {
        try {
            $category->name = (string) $request->input('categoryName');
            if($request->input('parentCategory') !== $category->id) {
                $category->parent_id = (int) $request->input('parentCategory');
            }
            $category->description = (string) $request->input('categoryDescription');
            $category->content = (string) $request->input('categoryDetail');
            $category->active = (boolean) $request->input('categoryActive');
            $category->save();
            Session::flash('success', 'Successfully update category ' . $category->name);
            return true;
        } catch(\Exception $err) {
            Session::flash('error', 'Failed update category');
            Log::info($err->getMessage());
            return false;
        }
    }

    public function delCategory($request) {
        $id=$request->input('id');
        $isExist=Categories::where('id', $id)->first();
        if($isExist) {
            return Categories::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id) {
        return Categories::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProducts($category, $request) {
        $query = $category->products()
        ->select('id', 'name', 'price', 'price_sale', 'image')
        ->where('active', 1);
        if($request->input('sortByPrice') == 'asc') {
            $query->orderby('price_sale');
        } else if ($request->input('sortByPrice') == 'desc') {
            $query->orderbyDesc('price_sale');
        } else if ($request->input('sortByName') == 'az') {
            $query->orderby('name');
        } else if ($request->input('sortByName') == 'za') {
            $query->orderbyDesc('name');
        }
        return $query->orderByDesc('id')
        ->paginate(4);
    }
};