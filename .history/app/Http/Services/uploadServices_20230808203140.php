<?php 

namespace App\Http\Services;

class uploadServices {
    public function store($request) {
        if($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('public/uploads/'.date("Y/m/d"), $name);
            dd($path);
        }
    }
}