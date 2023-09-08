<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index($title) {
        $title = $title === 'login' ? 'Login' : 'Register';
        return view('authPage.index', [
            'title' => $title
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

    public function addUser(Request $request) {
        try {
            $password = Hash::make($request->input('password'));
            User::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'password' => (string) $password,
            ]);
            Session::flash('success', 'Create account successful');
            return redirect('/login');
        } catch(\Exception $err) {
            Session::flash('error', 'Failed to create account');
            Log::info($err);
            return redirect()->back();
        }
    }
}
