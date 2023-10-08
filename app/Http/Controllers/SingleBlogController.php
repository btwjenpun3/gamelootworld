<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;

class SingleBlogController extends Controller
{
    public function index(Request $request) {
        $slug = $request->slug;
        $todayDate = Carbon::now();
        $data = Post::where('slug', $slug)->first();
        $comments = Comment::where('post_id', $data->id)->get();
        foreach($comments as $comment) {
            $comment->diffTime = $this->diffTime($comment->created_at);
        }
        $relatedPosts = Post::where('platforms', 'LIKE', '%'.$data->platforms.'%')->limit(4)->get();        
        $platforms = $data->platforms()->get();
        return view('Pages.Single Blog.index', [
            'id' => $data->id,
            'title' => $data->title,
            'image' => $data->image,
            'worth' => $data->worth,
            'platforms' => $platforms,
            'description' => $data->description,
            'instructions' => preg_split('/(\d+\.) /', $data->instructions, -1, PREG_SPLIT_NO_EMPTY),
            'url' => $data->open_giveaway_url,
            'redirect_url' => $data->redirect_url,
            'related_posts' => $relatedPosts,
            'today_date' => $todayDate,
            'expired_on' => $data->end_date,
            'status' => $data->status,
            'comments' => $comments,
            'slug' => $slug
        ]);
    }

    public function diffTime($time) {
        $now = Carbon::now();
        $get_time = Carbon::parse($time);
        $seconds = $get_time->diffInSeconds($now);
        $minutes = $get_time->diffInMinutes($now);
        $hours = $get_time->diffInHours($now);
        $days = $get_time->diffInDays($now);
        
        if($seconds < 60) {
            return $seconds.' seconds ago';
        } elseif($seconds > 60 && $seconds < 3600) {
            return $minutes.' minutes ago';
        } elseif($seconds > 3600 && $seconds <= 86400) {
            return $hours.' hours ago';
        } elseif($seconds > 86400) {
            return $days.' days ago';
        }
    }
}
