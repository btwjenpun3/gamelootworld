<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // !! ------------------------------------------------- !! //
    // !! ------------------- Dashboard ------------------- !! //

    public function index() {
        return view('Pages.Admin.Dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function loginForm() {
        return view('Pages.Admin.Login.index');
    }

    // !! ------------------------------------------------- !! //
    // !! ------------------- Login  ------------------- !! //

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

    // !! ------------------------------------------------- !! //
    // !! ------------------- Posts  ------------------- !! //

    public function posts() {
        $posts = Post::select('id', 'title', 'published_date', 'end_date', 'status', 'created_at')->orderBy('source_id', 'desc')->paginate(10);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('Pages.Admin.Blog.index', [
            'title' => 'Posts',
            'posts' => $posts,
            'now' => $now
        ]);
    }

    public function postCreate() {
        return view('Pages.Admin.Blog.new', [
            'title' => 'New Post'
        ]);
    }

    public function postCreateProcess(Request $request) {
        $request->validate([
            'source_id' => 'required',
            'title' => 'required',
            'worth' => 'required',
            'platforms' => 'required',
            'description' => 'required',
            'instructions' => 'required',
            'original_url' => 'required',
            'redirect_url' => 'required'     
        ]);
        $status = $request->status;
        $imageData = file_get_contents($request->image);
        $imageName = basename($request->image);
        $imagePath = 'post/images/' . $imageName;
        Storage::disk('public')->put($imagePath, $imageData);
        if($request->status != 'Expired') {
            $status = 'Active';
        };
        Post::create([
            'source_id' => $request->source_id,
            'title' => $request->title,
            'platforms' => $request->platforms,
            'worth' => $request->worth,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'type' => $request->type,
            'image' => $imageName,
            'thumbnail' => $request->thumbnail,
            'open_giveaway_url' => $request->original_url,
            'redirect_url' => $request->redirect_url,
            'published_date' => $request->published_date,
            'end_date' => $request->end_date,
            'slug' => Str::slug($request->title),
            'status' => $status
        ]);

        return redirect()->route('indexAdminPosts');
    }

    public function postEdit(Request $request) {
        $post = Post::find($request->id);
        $url = env('APP_URL');
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('Pages.Admin.Blog.edit', [
            'title' => 'Edit Post ' . $post->title,
            'post' => $post,
            'now' => $now ,
            'url' => $url
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

    public function postDeleteProcess(Request $request) {
        $post = Post::find($request->id);
        $post->delete();
        return redirect()->route('indexAdminPosts')->with('deleted', 'Post successfully deleted');
    }

    // !! ------------------------------------------------- !! //
    // !! ------------------- Fetch  ------------------- !! //    
}