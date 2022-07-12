<?php

namespace App\Http\Controllers;

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
            'password' => ['required', 'confirmed','min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
        ]);

        return redirect('/');
    }
}
