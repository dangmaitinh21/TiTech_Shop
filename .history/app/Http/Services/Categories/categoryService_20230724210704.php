<?php

namespace App\Http\Services\Categories;

use App\Models\Categories;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class categoryService {
    public function create($request) {
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
};