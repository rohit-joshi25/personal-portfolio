<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GithubActivityController;

Route::get('/about/github-activity', [GithubActivityController::class, 'index'])->name('about.github.activity');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Services
Route::get('/services', function () {
    return view('services.index');
})->name('services.index');

// Blog Index
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

// Blog Posts
Route::get('/blog/why-i-chose-web-development', function () {
    return view('blog.post1');
})->name('blog.post1');

Route::get('/blog/php-vs-javascript-backend', function () {
    return view('blog.post2');
})->name('blog.post2');

Route::get('/blog/laravel-best-practices', function () {
    return view('blog.post3');
})->name('blog.post3');
