<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {    
        $dlcs = Post::where('type', 'DLC')->limit(4)->latest('source_id')->get(); 
        $steam = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->limit(4)->latest('source_id')->get(); 
        $epic = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->limit(4)->latest('source_id')->get();
        $gog = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->limit(4)->latest('source_id')->get();            
        return view('Pages.Home.index', [
            'steams' => $steam,
            'epics' => $epic,
            'dlcs' => $dlcs,
            'gogs' => $gog
        ]);
    }    
}
