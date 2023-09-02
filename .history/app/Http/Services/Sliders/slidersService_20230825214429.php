<?php
namespace App\Http\Services\Sliders;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            Session::flash('success', 'Successfully update slider ' . $slider->name);
            return true;
        } catch(\Exception $err) {
            Session::flash('error', 'Failed to update slider');
            Log::info($err->getMessage());
            return false;
        }
    }

    public function delSlider($request) {
        $slider=Slider::where('id', $request->input('id'))->first();
        if($slider) {
            $path = str_replace('storage', 'public', $slider->image);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }
}