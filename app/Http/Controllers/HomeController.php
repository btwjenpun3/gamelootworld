<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\CollectionController;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{   
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
            'title' => 'Homepage',
            'datas' => Post::orderByRaw("CASE WHEN status = 'Active' THEN 1 ELSE 2 END")->orderBy('created_at', 'desc')->paginate(20)
        ]);       
    }    
}
