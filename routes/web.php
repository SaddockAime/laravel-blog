<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

// Redirect home page to blog
Route::get('/', function () {
    return redirect()->route('blog.index');
});

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
