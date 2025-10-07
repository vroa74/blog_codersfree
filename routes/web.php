<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('posts', PostController::class)->names('posts'); 


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
