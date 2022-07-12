<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login() {
        return view('users.login');
    }

    public function register() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formValue = $request->validate([
            'name' => ['required', 'min:6'],
            'email' => ['required', 'email', 'unique:users'],

            // Regular expressions 
            // English uppercase characters (A – Z)
            // English lowercase characters (a – z)
            // Base 10 digits (0 – 9)
            // Non-alphanumeric (For example: !, $, #, or %)
            // Unicode characters
            'password' => ['required', 'confirmed','min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'password_confirmation' => ['required']
        ]);

        $formValue['password'] = bcrypt($formValue['password']);

        $users = User::create($formValue);
        auth()->login($users);
        return redirect('/');
    }

    // Users logout
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Log in users
    public function authenticate(Request $request) {
        $formValue = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formValue)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()
            ->withErrors([
                'errorLoggingIn' => "Invalid Credentials"
            ]);

        // return back()->withErrors(['email' => "Invalid Credentials"])->onlyInput('email');
    }
}
