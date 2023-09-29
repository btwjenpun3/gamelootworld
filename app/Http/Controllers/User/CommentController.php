<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request) {
        $user = User::find(auth()->id());
        $validate = $request->validate([
            'comment' => 'required|max:200'
        ]);
        if($validate) {
            Comment::create([
                'user_id' => $user->id,
                'post_id' => $request->id,
                'comments' => $request->comment
            ]);
            return redirect()->route('loot.index', ['slug' => $request->slug]);
        }
    }
}
