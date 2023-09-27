<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    // !! ------------------------------------------------- !! //
    // !! ------------------- Dashboard ------------------- !! //

    public function dashboard() {
        $user = User::where('id', auth()->id())->first();
        $role = $user->role->name;
        return view('Pages.Admin.Dashboard.index', [
            'title' => 'Dashboard',
            'role' => $role
        ]);
    }

    public function index() {
        return view('Pages.Admin.Login.index');
    }

    // !! ------------------------------------------------- !! //
    // !! ------------------- Login  ------------------- !! //

     public function login(Request $request) {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]
        );
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) { 
            $user = Auth::user();
            if($user->role->name == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login');
            }            
        }
        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }   
}
