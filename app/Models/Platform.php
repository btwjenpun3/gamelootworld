<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_platforms', 'platform_id', 'post_id');
    }
}
