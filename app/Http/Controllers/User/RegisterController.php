<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view('Pages.User.register');
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6'
        ]);
        if($validate) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => 2
            ]);
            return redirect()->route('login.index')->with(['registration_success' => 'Registration success. Please login.']);
        } else {
            return redirect()->route('login.index')->with(['error' => 'Unknown error. Please contact us.']);
        }
    }
}
