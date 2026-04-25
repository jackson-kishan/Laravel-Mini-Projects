<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\LikeDislikeController;
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

  Route::get('active-users', [UserController::class, 'activeUser'])->name('active.user');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
