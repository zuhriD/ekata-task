<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auths.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
        }
        return redirect('/login');
    }
}
