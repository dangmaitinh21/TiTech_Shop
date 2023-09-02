<?php
namespace App\Http\Services\Sliders;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class slidersService {
    public function createSlider($request) {
        try {
            Slider::create($request->input());
            Session::flash('success', 'Successfully add new slider');
        } catch(\Exception $err) {
            Session::flash('error', 'Failed create new slider');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function getSliders() {
        return Slider::orderbyDesc('id')->paginate(15);
    }

    public function updateSlider($slider, $request) {
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Successfully update slider ' . $request->input('name'));
            return true;
        } catch(\Exception $err) {
            Session::flash('error', 'Failed to update slider');
            Log::info($err->getMessage());
            return false;
        }
    }

    public function delSlider($request) {
        $id=$request->input('id');
        $isExist=Slider::where('id', $id)->first();
        if($isExist) {
            Slider::where('id', $id)->delete();
            return true;
        }
        return false;
    }
}