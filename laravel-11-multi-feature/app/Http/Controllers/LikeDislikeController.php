<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeDislikeController extends Controller
{
    public function index()
    {
        $post = Post::get();
    }

    public function likes(Request $request)
    {

        $post = Post::find($request->id);
        $response = auth()->user()->toggleLikeDislike($post->id, $request->like);

        return response()->json(['success' => $response]);
    }
}
