<?php 

namespace App\Http\Services;

class uploadServices {
    public function store($request) {
        if($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $path = 'uploads/'.date("Y/m/d");
                $request->file('file')->storeAs('public/'.$path, $name);
                return $path.'/'.$name;
            } catch(\Exception $err) {
                return false;
            }
        }
    }
}