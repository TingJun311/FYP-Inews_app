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
            'password' => ['required', 'confirmed','min:8']
        ]);

        return redirect('/');
    }
}
