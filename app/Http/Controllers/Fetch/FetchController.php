<?php

namespace App\Http\Controllers\Fetch;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\FetchStatus;
use Illuminate\Support\Facades\Storage;


class FetchController extends Controller
{
    private $url;

    public function __construct() {
        $this->url = 'https://www.gamerpower.com/api/giveaways';
    }

    public function fetchGameContentFromUpstream() {
        //!!---- Ambil Konten Berupa JSON ----!!//
        $content = HTTP::get($this->url);
        $urlController = new UrlController();

        //!!---- Decode JSON ----!!
        $data = json_decode($content);        

        //!!---- Ambil Key Terakhir dari Arraay yang Tersedia ----!!
        $lastKey = count($data) - 1;

        FetchStatus::create([
                'status' => 'updated'
            ]);

        //!!---- Looping dan Masukkan ke Database Posts ----!!
        for($x = 0; $x <= $lastKey; $x++) {
            //!!---- Ambil Informasi Gambar ----!!
            $imageUrl = $data[$x]->image;
            $imageData = file_get_contents($imageUrl);
            $imageName = basename($imageUrl);
            $imagePath = 'post/images/' . $imageName;
            Storage::disk('public')->put($imagePath, $imageData);

            //!!---- Masukkan Data ke Database ----!!
            Post::create([
                'source_id' => $data[$x]->id,
                'title' => $data[$x]->title,
                'worth' => str_replace('$', '', $data[$x]->worth),
                'thumbnail' => $data[$x]->thumbnail,
                'image' => $imageName,
                'description' => $data[$x]->description,
                'instructions' => $data[$x]->instructions,
                'open_giveaway_url' => $data[$x]->open_giveaway_url,
                'redirect_url' => $urlController->generateUpstreamUrlToOwnUrl($data[$x]->open_giveaway_url),
                'type' => $data[$x]->type,
                'platforms' => $data[$x]->platforms,
                'published_date' => $data[$x]->published_date,
                'end_date' => $data[$x]->end_date,
                'status' => $data[$x]->status,
                'slug' => Str::slug($data[$x]->title)
            ]);            
        }        
        return response()->json([
            'code' => 200,
            'message' => "Post successfully updated"
        ], 200);
    }

    public function updateGameContentFromUpstream() {
        $getMaxId = Post::max('source_id');        
        $findDateFromMaxId = Post::where('source_id', $getMaxId)->first();
        $getDateFromMaxId = $findDateFromMaxId->published_date;
        $content = HTTP::get($this->url);
        $urlController = new UrlController();
        $data = json_decode($content);
        $filteredData = array_filter($data, function ($item) use ($getDateFromMaxId) {            
            return strtotime($item->published_date) > strtotime($getDateFromMaxId);           
        });
        $lastKey = count($filteredData) - 1;
        for($x = 0; $x <= $lastKey; $x++) {
            //!!---- Ambil Informasi Gambar ----!!
            $imageUrl = $data[$x]->image;
            $imageData = file_get_contents($imageUrl);
            $imageName = basename($imageUrl);
            $imagePath = 'post/images/' . $imageName;
            Storage::disk('public')->put($imagePath, $imageData);

            Post::create([
                'source_id' => $data[$x]->id,
                'title' => $data[$x]->title,
                'worth' => str_replace('$', '', $data[$x]->worth),
                'thumbnail' => $data[$x]->thumbnail,
                'image' => $imageName,
                'description' => $data[$x]->description,
                'instructions' => $data[$x]->instructions,
                'open_giveaway_url' => $data[$x]->open_giveaway_url,
                'redirect_url' => $urlController->generateUpstreamUrlToOwnUrl($data[$x]->open_giveaway_url),                
                'type' => $data[$x]->type,
                'platforms' => $data[$x]->platforms,
                'published_date' => $data[$x]->published_date,
                'end_date' => $data[$x]->end_date,
                'status' => $data[$x]->status,
                'slug' => Str::slug($data[$x]->title)
            ]);     
            $titles[] = $data[$x]->title;       
        }
        return response()->json([
            'code' => 200,
            'message' => "Post successfully updated"
        ], 200);
    }
    
    public function fetchGameContentUsingId(Request $request) {
        $content = HTTP::get('https://www.gamerpower.com/api/giveaway?id='.$request->source_id);
        if($content->status() == Response::HTTP_NOT_FOUND) {
            return response()->json([
                'code' => 404,
                'message' => 'Giveaway with ID ' . $request->source_id . ' not found. Please check your Source ID.'
            ], 404);
        } else {
            $urlController = new UrlController();
            $data = json_decode($content);  
            $data->redirect_url = $urlController->generateUpstreamUrlToOwnUrl($data->open_giveaway_url);     
            return response()->json($data);
        }        
    }  
  
    // !! ------------------ Telegram Fetch ---------------------- !! //
    public function updateGameContentFromUpstreamToTelegram() {
        $getMaxId = Post::max('source_id');        
        $findDateFromMaxId = Post::where('source_id', $getMaxId)->first();
        $getDateFromMaxId = $findDateFromMaxId->published_date;
        $content = HTTP::get($this->url);
        $urlController = new UrlController();
        $data = json_decode($content);
        $filteredData = array_filter($data, function ($item) use ($getDateFromMaxId) {            
            return strtotime($item->published_date) > strtotime($getDateFromMaxId);           
        });
        $lastKey = count($filteredData) - 1;
        for($x = 0; $x <= $lastKey; $x++) {
            //!!---- Ambil Informasi Gambar ----!!
            $imageUrl = $data[$x]->image;
            $imageData = file_get_contents($imageUrl);
            $imageName = basename($imageUrl);
            $imagePath = 'post/images/' . $imageName;
            Storage::disk('public')->put($imagePath, $imageData);

            Post::create([
                'source_id' => $data[$x]->id,
                'title' => $data[$x]->title,
                'worth' => str_replace('$', '', $data[$x]->worth),
                'thumbnail' => $data[$x]->thumbnail,
                'image' => $imageName,
                'description' => $data[$x]->description,
                'instructions' => $data[$x]->instructions,
                'open_giveaway_url' => $data[$x]->open_giveaway_url,
                'redirect_url' => $urlController->generateUpstreamUrlToOwnUrl($data[$x]->open_giveaway_url),                
                'type' => $data[$x]->type,
                'platforms' => $data[$x]->platforms,
                'published_date' => $data[$x]->published_date,
                'end_date' => $data[$x]->end_date,
                'status' => $data[$x]->status,
                'slug' => Str::slug($data[$x]->title)
            ]);     
            $titles[] = $data[$x]->title;       
        }
        if(isset($titles)) {
            $response = json_encode([
                'code' => 200,
                'message' => "Post berhasil di Update.",
                'titles' => $titles
            ], 200);
        $result = json_decode($response, true);
        return $result;
        } else {
            $response = json_encode([
            'code' => 200,
            'message' => "Tidak ada postingan terbaru."
        ], 200);
        $result = json_decode($response, true);
        return $result;
        }     
    }
}
