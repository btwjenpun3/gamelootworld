<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {    
        $dlcs = Post::where('type', 'DLC')->limit(4)->latest()->get(); 
        $steam = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->limit(4)->latest()->get(); 
        $epic = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->limit(4)->latest()->get();
        $gog = Post::where('platforms', 'LIKE', '%gog%')->where('type', 'Game')->limit(4)->latest()->get(); 
        $itch = Post::where('platforms', 'LIKE', '%itch%')->where('type', 'Game')->limit(4)->latest()->get();       
            return view('Pages.Home.index', [
                'steams' => $steam,
                'epics' => $epic,
                'dlcs' => $dlcs,
                'gogs' => $gog,
                'itchs' => $itch
            ]);       
        }    
}
