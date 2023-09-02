<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index() {
        return view('loginPage.main', [
            'account' => 'testing name',
        ]);
    }
}
