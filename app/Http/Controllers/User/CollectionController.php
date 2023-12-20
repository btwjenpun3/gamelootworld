<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\UserPost;

class CollectionController extends Controller
{
    public function index() {
        $user        = User::find(auth()->id());
        $collections = $user->posts()
                            ->distinct()
                            ->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('Pages.User.collection', [
            'title'         => 'My Collections',
            'collections'   => $collections
        ]);
    }

    public function add(Request $request) {
        $post               = Post::where('slug', $request->slug)->first();
        $check_collection   = $post->users()->where('user_id', auth()->id())->first();
        if(!isset($check_collection)) {
            UserPost::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id
            ]);
            return redirect()->route('loot.index', ['slug' => $request->slug])->with(['title' => $post->title]);
        } else {
            return redirect()->route('home.index');
        }   
    }

    public function getCollections() {
        $user = User::find(auth()->id());
        $collections = $user->posts()->get();
        return $collections;                 
    }

    public function destroy(Request $request) {
        $post = Post::where('slug', $request->slug)->first();
        $post->users()->detach(auth()->id());
        return redirect()->route('collection.index')->with(['title' => $post->title]);
    }

    public function singlePageDestroy(Request $request) {
        $post = Post::where('slug', $request->slug)->first();
        $post->users()->detach(auth()->id());
        return redirect()->route('loot.index', ['slug' => $post->slug])->with(['single_page_title' => $post->title]);
    }
}
