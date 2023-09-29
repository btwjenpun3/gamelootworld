<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('Pages.User.login');
    }

    public function login(Request $request) {
        $request->validate([
                'email' => ['required', 'email'],
                'password' => 'required',
            ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) { 
            $user = Auth::user();
            if($user->role->name == 'member' || $user->role->name == 'admin') {
                return redirect()->route('home.index')->with([
                    'login_success' => 'Welcome back, ' . auth()->user()->name
                ]);
            } else {
                return redirect()->route('login.index')->with([
                    'login_error' => 'These credentials do not match our records.',
                ]);
            }            
        }
        return redirect()->back()->with([
                'login_error' => 'These credentials do not match our records.',
            ]);
    }

    public function logout(Request $request) {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('home.index');
    }
}