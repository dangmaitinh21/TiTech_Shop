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

        // validate the fields that have been posted from the form
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);

        // validate data posted from the form to the database (default with 2 required fields, email and password, the remaining fields are optional)
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            return redirect()->route('adminLogin');
        } 

        // use flash method of session in laravel to quickly create a short-term storage data object used to notify an alert to the view
        Session::flash('error', 'Email or password is wrong');
        return redirect()->route('login');
    }
}
