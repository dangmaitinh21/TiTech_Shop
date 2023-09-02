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
}
