<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::post('/upload', [ProductController::class, 'upload'])->name('upload');

Route::get('/feed', [ProductController::class, 'feed'])->name('feed');
