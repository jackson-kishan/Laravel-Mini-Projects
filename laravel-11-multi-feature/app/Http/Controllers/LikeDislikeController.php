<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('likes.posts', compact('posts'));
    }

    public function likes(Request $request)
    {

        $post = Post::find($request->id);
        $response = Auth::user()->toggleLikeDislike($post->id, $request->like);

        return response()->json(['success' => $response]);
    }
}
