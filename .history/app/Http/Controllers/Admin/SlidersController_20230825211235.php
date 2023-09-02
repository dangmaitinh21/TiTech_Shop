<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Services\Sliders\slidersService;

class SlidersController extends Controller
{
    protected $sliders;
    
    public function __construct(slidersService $sliders)
    {
        $this->sliders = $sliders;
    }

    public function renderFormSlider() {
        return view('adminPage.sliders.add', [
            'title'=>'Add new slider'
        ]);
    }

    public function createSlider(Request $request) {
        $this->validate($request, [
            'name'=>'required',
            'image'=>'required',
            'url'=>'required'
        ]);
        $result = $this->sliders->createSlider($request);
        if($result) {
            return redirect('/admin/sliders/list');
        }
        return redirect()->back();
    }

    public function getSliders() {
        return view('adminPage.sliders.list', [
            'title'=>'List sliders',
            'sliders'=>$this->sliders->getSliders()
        ]);
    }
    
    public function editFormSlider(Slider $slider) {
        return view('adminPage.sliders.edit', [
            'title'=>'Edit slider',
            'slider'=>$slider
        ]);
    }

    public function delSlider(Request $request) {
        $result = $this->sliders->delSlider($request);
        if($result) {
            return response()->json([
                'error'=>false,
                'message'=>'Successfully delete slider'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Failed delete slider'
        ]);
    }
}
