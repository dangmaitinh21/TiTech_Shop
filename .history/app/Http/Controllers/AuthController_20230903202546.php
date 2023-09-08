<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index() {
        return view('authPage.index', [
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
            $user = Auth::user();
            if($user->isAdmin) {
                return redirect('/admin');
            }
            // return redirect()->route('adminLogin');
            return redirect('/');
        } 

        // use flash method of session in laravel to quickly create a short-term storage data object used to notify an alert to the view
        Session::flash('error', 'Email or password is wrong');
        return redirect()->back();
    }
}
