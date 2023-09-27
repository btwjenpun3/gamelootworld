<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        $posts = Post::select('id', 'title', 'published_date', 'end_date', 'status', 'created_at')->latest()->paginate(10);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('Pages.Admin.Blog.index', [
            'title' => 'Posts',
            'posts' => $posts,
            'now' => $now
        ]);
    }

    public function create() {
        return view('Pages.Admin.Blog.new', [
            'title' => 'New Post'
        ]);
    }

    public function store(Request $request) {
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
        return redirect()->route('admin.posts.index')->with(['created' => 'Post successfully created']);
    }

    public function edit(Request $request) {
        $post = Post::find($request->id);
        $url = env('APP_URL');
        $source_url = str_replace('/open/', '/', $post->open_giveaway_url);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('Pages.Admin.Blog.edit', [
            'title' => 'Edit Post ' . $post->title,
            'post' => $post,
            'now' => $now ,
            'url' => $url,
            'source_url' => $source_url
        ]);
    }

    public function update(Request $request) {
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
        return redirect()->route('admin.posts.edit', ['id' => $request->id])->with('success', 'Post successfully edited.');
    }

    public function destroy(Request $request) {
        $post = Post::find($request->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post successfully deleted');
    }
}
