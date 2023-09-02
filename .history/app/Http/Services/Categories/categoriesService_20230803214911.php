<?php

namespace App\Http\Services\Categories;

use App\Models\Categories;
use Exception;
use Illuminate\Support\Facades\Session;

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
        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        };
    }

    public function getParent() {
        return Categories::where('parent_id', 0)->get();
    }

    public function getCategories() {
        return Categories::orderbyDesc('id')->paginate(15);
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
            Session::flash('success', 'Successfully update category');
            return true;
        } catch(Exception $err) {
            Session::flash('error', $err->getMessage());
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
};