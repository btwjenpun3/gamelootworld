<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index() {
        return view('Pages.Admin.Dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function loginForm() {
        return view('Pages.Admin.Login.index');
    }

    public function posts() {
        $posts = Post::select('id', 'title', 'published_date', 'end_date', 'status')->paginate(10);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('Pages.Admin.Blog.index', [
            'title' => 'Posts',
            'posts' => $posts,
            'now' => $now
        ]);
    }

    public function postEdit(Request $request) {
        $post = Post::find($request->id);
        return view('Pages.Admin.Blog.edit', [
            'title' => 'Edit Post ' . $post->title,
            'post' => $post 
        ]);
    }

    public function postEditProcess(Request $request) {
        $post = Post::find($request->id);
        $request->validate([
            'title' => 'required',
            'worth' => 'required',
            'platforms' => 'required',
            'description' => 'required',
            'instructions' => 'required',
            'original_url' => 'required',
            'redirect_url' => 'required'       
        ]);
        $status = $request->status;
        if($request->status != 'Expired') {
            $status = 'Active';
        };
        $post->update([
            'title' => $request->title,
            'platforms' => $request->platforms,
            'worth' => $request->worth,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'open_giveaway_url' => $request->original_url,
            'redirect_url' => $request->redirect_url,
            'published_date' => $request->published_date,
            'end_date' => $request->end_date,
            'status' => $status
        ]);

        return redirect()->route('indexAdminPostEdit', ['id' => $request->id])->with('success', 'Post successfully edited.');
    }

    public function loginProccess(Request $request) {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]
        );
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) { 
            return redirect()->route('indexAdmin');
        }
        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }
}
