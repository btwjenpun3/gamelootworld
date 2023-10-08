<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function homepagePosts($name) {
        $posts = Post::where('platforms', 'LIKE', '%'.$name.'%')->where('type', 'Game')->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('id', 'asc')->limit(4)->get();   
        return $posts;
    }

    public function homepageDlcs($name) {
        $posts = Post::where('type', 'DLC')->limit(4)->orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('id', 'asc')->get();   
        return $posts;
    }

    public function priceDisplay($price, $status) {
        if ($price >= 'N/A' && $status == 'Active')
           echo '';
        elseif($status == 'Expired')
            echo '';
        elseif ($price >= '0' && $price <= '4.99')
            echo '<div class="standard">$' . $price . '</div>';
        elseif ($price >= '5' && $price <= '9.99')
            echo '<div class="epic">$' . $price . '</div>';
        elseif ($price >= '10')
            echo '<div class="legendary">$' . $price . '</div>';
    }

    public function index() { 
        // $price = $this->priceDisplay();
        return view('Pages.Home.index', [
            'steams' => $this->homepagePosts('Steam'),
            'epics' => $this->homepagePosts('Epic'),
            'dlcs' => $this->homepageDlcs('DLC'),
            'gogs' => $this->homepagePosts('GOG'),
            'itchs' => $this->homepagePosts('Itch'),
        ]);       
    }    
}
