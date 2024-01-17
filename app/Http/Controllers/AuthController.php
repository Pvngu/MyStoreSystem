<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show() {
        return view('login');
    }

    public function login() {
        validator(request()->all(), [
            'username' => 'required',
            'password' => 'required'
        ])->validate();

        if(auth()->attempt(request()->only(['username', 'password']))) {
            return redirect('/home');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}