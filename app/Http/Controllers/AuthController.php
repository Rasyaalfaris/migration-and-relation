<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        $title = 'Login Page';
        return view('auth.login', compact('title'));
    }
    public function store(request $request) {
        dd($request->all());
    }
}
