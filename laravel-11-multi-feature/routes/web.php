<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jquery form validation
Route::get('users/create', [FormController::class, 'create'])->name('users.create');
Route::post('users/create', [FormController::class, 'store'])->name('users.store');
