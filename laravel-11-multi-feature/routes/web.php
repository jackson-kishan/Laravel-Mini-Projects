<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\UploadImageController;
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
Route::middleware('auth')->group(function () {
  Route::get('/posts',[LikeDislikeController::class, 'index'])->name('ld.index');
  Route::post('/posts/like-dislike',[LikeDislikeController::class, 'likes'])->name('ld.store');
});
