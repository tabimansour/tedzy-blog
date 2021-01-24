<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        $posts = Posts::orderBy('created_at', 'DESC')->with('user', 'likes')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    public function private() {
        $posts = Posts::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->paginate(5);
        return view('dashboard')->with('posts', $posts);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required|min:10'
        ]);

//      Eloquent Relationship in Models
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

//      Basic system to create db insert data
//      Posts::create([
//          'user_id' => auth()->user()->id,
//          'body' => $request->body
//      ]);

        return back();
    }

    public function destroy(Posts $post) {
        // name of the function in Policies\PostPolicy
        $this->authorize('delete', $post);
        $post->delete();

//        if(!$post->ownedBy(auth()->user())) {
//            $post->delete();
//        }


//        if($post->user_id === auth()->id()) {
//            $post->delete();
//        }
        //return response(null, 409);
        return back();
    }
}
