<?php

namespace App\Http\Controllers;

use App\Models\NotificationPost;
use App\Notifications\PostApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationPostController extends Controller
{

  public function index()
  {
    $posts = NotificationPost::get('*');

    return view("notifications.post-notifications", ['posts' => $posts]);
  }

  public function store(Request $request)
  {
    $validator = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string|',
    ]);

    if($validator){
        NotificationPost::create([
         'title' => $request->title,
         'body' => $request->body,
         'user_id' => auth()->user()->id,
        ]);
    }

    return back()->with('success', 'Post Successfully Created!');
  }

  public function approve(Request $request,int $id)
  {

   if(!Auth::user()->is_admin) {
     return back()->with('success', "your are not super admin");
   }

   $post = NotificationPost::firstOrFail($id);

   if($post && !$post->is_approved) {
    $post->is_approved = 1;
    $post->save();
    // $post->refresh();
    // dd($post);

    if($post->user) {
        $post->user->notify(new PostApproved($post));
    }

    return back()->with("success", "Post approved and user notified");
   }

   return back()->with("success", "Post not found or already approved");
  }

  public function markAsRead(Request $request,int $id)
  {
   $notification = Auth::user()->unreadNotifications->find($id);
   $notification->markAsRead();

   return back()->with("success", "Added mark as read.");
  }
}
