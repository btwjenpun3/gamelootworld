<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class SingleBlogController extends Controller
{
    public function index(Request $request) {
        $slug = $request->slug;
        $todayDate = Carbon::now();
        $data = Post::where('slug', $slug)->first();
        $relatedPosts = Post::where('platforms', 'LIKE', '%'.$data->platforms.'%')->limit(4)->get();        
        return view('Pages.Single Blog.index', [
            'title' => $data->title,
            'image' => $data->image,
            'worth' => $data->worth,
            'platforms' => $data->platforms,
            'description' => $data->description,
            'instructions' => preg_split('/(\d+\.) /', $data->instructions, -1, PREG_SPLIT_NO_EMPTY),
            'url' => $data->open_giveaway_url,
            'redirect_url' => $data->redirect_url,
            'related_posts' => $relatedPosts,
            'today_date' => $todayDate,
            'expired_on' => $data->end_date,
            'status' => $data->status
        ]);
    }
}
