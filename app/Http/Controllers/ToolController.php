<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\FetchStatus;
use Carbon\Carbon;

class ToolController extends Controller
{
    public function autoMachineIndex() {
        $status = FetchStatus::first();
        return view('Pages.Admin.Tools.Auto Machine.index', [
            'title' => 'Auto Machine',
            'status' => $status
        ]);
    }   

    public function updateStatus() {
        $posts = Post::all();
        $now = Carbon::now()->format('Y-m-d H:i:s');
        foreach($posts as $post) {
            if($post->end_date == 'N/A') {
                $post->update([
                    'status' => 'Active'
                ]);
            } elseif ($post->end_date <= $now) {
                $post->update([
                    'status' => 'Expired'
                ]);
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Posts Status successfully updated'
        ], 200);
    }
}
