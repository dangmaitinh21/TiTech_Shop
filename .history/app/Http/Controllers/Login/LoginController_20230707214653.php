<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('loginPage.index', [
            'title'=> 'Login'
        ]);
    }
}
