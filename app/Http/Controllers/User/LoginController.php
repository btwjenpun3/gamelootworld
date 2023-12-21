<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
            if($user->status == 'active') {
                return redirect()->route('home.index')->with([
                    'login_success' => 'Welcome back, ' . auth()->user()->name
                ]);
            
            } else if ($user->status == 'banned') {
                Auth::logout(); 
                $request->session()->invalidate(); 
                $request->session()->regenerateToken();
                return redirect()->route('login.index')->with([
                    'login_error' => 'Your account get banned. Please contact us if you feel its mistake.'
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
        return redirect()->route('login.index')->with(['logout_success' => 'Logout success.']);
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->user();
        $user       = User::where('email', $googleUser->getEmail())->first();
        if(!$user) {
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'password'  =>  bcrypt(Str::random(20)),
                'role_id'   => 2,
                'status'    => 'active'
            ]);
        } 
        Auth::login($user);
        return redirect()->route('home.index')->with([
            'login_success' => 'Welcome back, ' . auth()->user()->name
        ]);
    }
}
