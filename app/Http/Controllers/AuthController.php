<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        if(Auth::check())
        {
            return back();
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        if(Auth::check())
        {
            return back();
        }
        
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
        $credentials = $request->validate([
            'user_id' => ['required', 'string'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'user_id' => 'User ID atau password salah.',
        ])->onlyInput('user_id');
    }

    public function logout(Request $request) 
    {
         Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
