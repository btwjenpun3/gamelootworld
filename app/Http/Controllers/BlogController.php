<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function allIndex() {    
        $data = Post::where('type', 'Game')->latest('source_id')->paginate(12);
        $count = Post::where('type', 'Game')->count();  
        return view('Pages.Blog.index', [
            'title' => 'All Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function allDlcIndex() {    
        $data = Post::where('type', 'DLC')->latest('source_id')->paginate(12);  
        $count = Post::where('type', 'DLC')->count();
        return view('Pages.Blog.index', [
            'title' => 'DLCs Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    }

    public function steamIndex() {    
        $data = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Steam Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function epicIndex() {    
        $data = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'Epic Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 

    public function gogIndex() {    
        $data = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->latest('source_id')->paginate(12);  
        $count = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->count(); 
        return view('Pages.Blog.index', [
            'title' => 'GOG Free Giveaways',
            'datas' => $data,
            'count' => $count
        ]);
    } 
}
