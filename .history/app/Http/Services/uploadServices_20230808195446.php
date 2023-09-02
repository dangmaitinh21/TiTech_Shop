<?php 

namespace App\Http\Services;

class uploadServices {
    public function store($request) {
        if($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads');
            return dd($path);
        }
    }
}