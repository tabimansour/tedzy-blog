<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Posts $post, Request $request) {
        $post->likes()->create([
            'user_id' => auth()->id(),
            'post_id' => $post->id
        ]);

        return back();
    }
}
