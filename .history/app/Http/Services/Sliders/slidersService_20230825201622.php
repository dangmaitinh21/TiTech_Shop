<?php
namespace App\Http\Services\Sliders;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class slidersService {
    public function createSlider($request) {
        try {
            Slider::create([$request->input(), 'active'=>(bool) $request->input('active')]);
            Session::flash('success', 'Successfully add new slider');
        } catch(\Exception $err) {
            Session::flash('error', 'Failed to create new slider');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}