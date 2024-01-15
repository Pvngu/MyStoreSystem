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
            'email' => 'required',
            'password' => 'required'
        ])->validate();

        if(auth()->attempt(request()->only(['email', 'password']))) {
            return redirect('/home');
        }

        return redirect()->back();
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}