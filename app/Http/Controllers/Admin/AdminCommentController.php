<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SingleBlogController;
use Illuminate\Http\Request;
use App\Models\Comment;
use Carbon\Carbon;

class AdminCommentController extends Controller
{
    public function index() {
        $comments = Comment::paginate(10);
        $init_time = new SingleBlogController;
        foreach($comments as $comment) {
            $comment->diffTime = $init_time->diffTime($comment->created_at);
        }
        return view('Pages.Admin.Comment.index', [
            'title' => 'Comments',
            'comments' => $comments
        ]);
    }
}
