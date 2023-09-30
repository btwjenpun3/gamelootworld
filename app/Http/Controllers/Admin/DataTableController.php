<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\Post;

class DataTableController extends Controller
{
    public function users(){
        $users = User::all();
        return DataTables::of($users)->toJson();
    }

    public function posts(){
        $posts = Post::all();
        return DataTables::of($posts)->toJson();
    }
}
