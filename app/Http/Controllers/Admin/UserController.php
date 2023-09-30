<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('Pages.Admin.User.index', [
            'title' => 'User',
            'users' => $users
        ]);
    }

    public function edit(Request $request) {
        $user = User::where('id', $request->id)->first();
        return view('Pages.Admin.User.edit', [
            'title' => 'User Edit',
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'role_id' => 'required',
            'status' => 'required'
        ]);
        if($validate){
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'status' => $request->status
            ];   
            if($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }    
            User::where('id', $request->id)->update($data);     
            return redirect()->route('admin.user.edit', ['id' => $request->id])->with(['success' => 'User ' . $request->email . ' successfully updated']);
        }
        return redirect()->route('admin.user.edit', ['id' => $request->id])->with(['failed' => 'User ' . $request->email . ' failed updated']);
    }
}
