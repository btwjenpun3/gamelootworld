<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index(Request $request) {
        $data = Platform::where('slug', $request->slug)->get();
        $platform = $data->first()->name;
        foreach($data as $post) {
            $posts = $post->posts()->paginate(12);
        }
        return view('Pages.Platforms.index', [
            'title' => 'Platform',
            'platform' => $platform,
            'datas' => $posts
        ]);
    }
}
