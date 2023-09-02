<?php

namespace App\Http\Controllers;

use App\Http\Services\Categories\categoriesService;
use App\Http\Services\Sliders\slidersService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $sliders, $categories;
    public function __construct(slidersService $sliders, categoriesService $categories)
    {
        $this->sliders = $sliders;
        $this->categories = $categories;
    }

    public function index() {
        return view('main', [
            'title' => 'The world of Cars',
            'sliders' => $this->sliders->getSliders(),
            'categories' => $this->categories->show()
        ]);
    }
}
