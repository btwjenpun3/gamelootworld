<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SiteMapController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->view('Pages.Sitemap.index', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');;
    }
}
