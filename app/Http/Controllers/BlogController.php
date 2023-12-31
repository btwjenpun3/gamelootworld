<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Platform;
use App\Models\UserPost;

class BlogController extends Controller
{
    public function games() {    
        $data = Post::where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);
        $count = Post::where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Games Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function dlcs() {    
        $data = Post::where('type', 'DLC')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);  
        $count = Post::where('type', 'DLC')->count();
        return view('Pages.Blog.index', [
            'title' => 'DLCs Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    }

    public function steam() {    
        $data = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Steam Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function epic() {    
        $data = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Epic Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function gog() {    
        $data = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'GOG Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function itch() {    
        $data = Post::where('platforms', 'LIKE', '%itch%')->where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%itch%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Itch.io Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 
}
