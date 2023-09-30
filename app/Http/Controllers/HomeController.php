<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function homepagePosts($name) {
        $posts = Post::where('platforms', 'LIKE', '%'.$name.'%')->where('type', 'Game')->latest()->limit(4)->get();   
        return $posts;
    }

    public function homepageDlcs($name) {
        $posts = Post::where('type', 'DLC')->limit(4)->latest()->get();   
        return $posts;
    }

    public function index() {  
            return view('Pages.Home.index', [
                'steams' => $this->homepagePosts('Steam'),
                'epics' => $this->homepagePosts('Epic'),
                'dlcs' => $this->homepageDlcs('DLC'),
                'gogs' => $this->homepagePosts('GOG'),
                'itchs' => $this->homepagePosts('Itch'),
            ]);       
        }    
}
