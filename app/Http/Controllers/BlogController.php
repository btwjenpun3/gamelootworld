<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UserPost;

class BlogController extends Controller
{
    public function games() {    
        $data = Post::where('type', 'Game')->latest('source_id')->paginate(12);
        $count = Post::where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Games Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function dlcs() {    
        $data = Post::where('type', 'DLC')->latest('source_id')->paginate(12);  
        $count = Post::where('type', 'DLC')->count();
        return view('Pages.Blog.index', [
            'title' => 'DLCs Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    }

    public function steam() {    
        $data = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Steam Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function epic() {    
        $data = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Epic Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function gog() {    
        $data = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'GOG Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 
}
