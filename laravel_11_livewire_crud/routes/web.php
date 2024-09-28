<?php

use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/products", Products::class);
