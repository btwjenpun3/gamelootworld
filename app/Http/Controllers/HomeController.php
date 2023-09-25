<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {    
        $dlcs = Post::where('type', 'DLC')->limit(4)->latest('source_id')->get(); 
        $steamGames = Post::where('platforms', 'LIKE', '%steam%')->where('type', 'Game')->limit(4)->latest('source_id')->get(); 
        $epicGames = Post::where('platforms', 'LIKE', '%epic%')->where('type', 'Game')->limit(4)->latest('source_id')->get();
        $GogGames = Post::where('platforms', 'LIKE', '%GOG%')->where('type', 'Game')->limit(4)->latest('source_id')->get();            
        return view('Pages.Home.index', [
            'steams' => $steamGames,
            'epics' => $epicGames,
            'dlcs' => $dlcs,
            'gogs' => $GogGames
        ]);
    }    
}
