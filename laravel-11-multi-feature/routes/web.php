<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationPostController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jquery form validation
Route::get('users/create', [FormController::class, 'create'])->name('users.create');
Route::post('users/create', [FormController::class, 'store'])->name('users.store');


// Image Upload
Route::get('upload', [UploadImageController::class, 'index']);
Route::get('upload', [UploadImageController::class, 'store']);

// Like Dislike System
Route::middleware(['auth', 'userActivity'])->group(function () {
  Route::get('/posts',[LikeDislikeController::class, 'index'])->name('like.dislike.index');
  Route::post('/posts/like-dislike',[LikeDislikeController::class, 'likes'])->name('like.dislike.store');

  //Show active users
  Route::get('active-users', [UserController::class, 'activeUser'])->name('active.user');

  //Delete and Restore users
  Route::get('show-users', [UserController::class, 'showUsersIndex'])->name('users.index');
  Route::delete('users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
  Route::get('users/restore/{id}', [UserController::class, 'restoreUser'])->name('users.restore');
  Route::get('restore-all', [UserController::class, 'restoreAllUsers'])->name('users.restore.all');

  //Send Post approvel notification
  Route::get('/notify-posts', [NotificationPostController::class, 'index'])->name('notify.posts.index');
  Route::post('/notify-posts', [NotificationPostController::class, 'store'])->name('notify.posts.store');
  Route::get('/notify-posts/{id}/approve', [NotificationPostController::class, 'approve'])->name('notify.posts.approve');
  Route::get('/notify-posts/{id}/mark-as-read', [NotificationPostController::class, 'markAsRead'])->name('notify.posts.mark.as.read');


  //Qr code generator
  Route::get('/qr-code', [QrCodeController::class, 'index'])->name('qr.code.index');


  //Send Mail using Queue
  Route::get('/send-mail', [MailController::class, 'index'])->name('send.mail.index');
});

//Stripe Payment
Route::controller(StripePaymentController::class)->group(function() {
   Route::get('stripe', 'stripe');
   Route::post('stripe', 'stripePost')->name('stripe.post');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
