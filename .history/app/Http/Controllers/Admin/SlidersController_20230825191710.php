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
}
