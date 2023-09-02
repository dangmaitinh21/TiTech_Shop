<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('loginPage.index', [
            'title' => 'Login'
        ]);
    }

    public function loginAuth(Request $request) {
        // The dd method dumps the collection's items and ends execution of the script
        dd($request->input());
        $this -> $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
    }
}