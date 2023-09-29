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
        $user = User::find(auth()->id());
        $collections = $user->posts()->distinct()->get();
        return view('Pages.User.collection', [
            'collections' => $collections
        ]);
    }

    public function add(Request $request) {
        $post = Post::find($request->id);
        $user = User::where('id', auth()->id())->first();
        if(isset($post) && isset($user)) {
            UserPost::create([
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);
            return redirect()->route('home.index');
        }
        return redirect()->route('home.index');
    }

    public function getCollections() {
        $user = User::find(auth()->id());
        $collections = $user->posts()->get();
        return $collections;                 
    }
}
