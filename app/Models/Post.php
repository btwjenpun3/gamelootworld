<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_posts', 'post_id', 'user_id');
    }
}
