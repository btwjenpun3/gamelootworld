<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Crypt;

class UrlController extends Controller
{
    public function generateUpstreamUrlToOwnUrl($url) {
        $cryptedUrl = Crypt::encrypt($url);
        $getLastCharacters = substr($cryptedUrl, 20, 6);
        return $getLastCharacters;
    }

    public function urlRedirect(Request $request){
        $getUrl = $request->url;
        $upstreamUrl = Post::where('redirect_url', $getUrl)->first();
        return redirect($upstreamUrl->open_giveaway_url);
    }
}
