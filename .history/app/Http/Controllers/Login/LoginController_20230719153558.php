<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login() {
        return view('loginPage.index', [
            'title' => 'Login'
        ]);
    }

    public function loginAuth(Request $request) {
        // The dd method dumps the collection's items and ends execution of the script (dd like var_dump() function in php)
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            return redirect()->route('mainLogin');
        } 

        Session::flash('error', 'Email or password is wrong');
        return redirect()->back();
    }
}
