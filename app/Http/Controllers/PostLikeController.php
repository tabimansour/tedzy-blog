<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Posts $post, $mode, Request $request) {
        if($mode == 'like') {
            if(!$post->likedBy($request->user())) {
                $post->likes()->create([
                    'user_id' => auth()->id(),
                    'post_id' => $post->id
                ]);
            }
        } else {
            if($post->likedBy($request->user())) {
                $post->likes()->delete([
                    'user_id' => auth()->id(),
                    'post_id' => $post->id
                ]);
            } else {
                //return response(null, 409);
            }
        }

        return back();
    }
}
