<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\UserController;

    Route::get('/', function () {
        return view('welcome');
    });
    // Route::resource('posts', PostController::class)->names('posts'); 

    // Grupo de las 7 rutas de recursos definidas manualmente con el nombre 'envio'
    Route::name('envio.')->group(function () {
        Route::get('/posts', [PostController::class, 'index'])->name('index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('create');
        Route::post('/posts', [PostController::class, 'store'])->name('store');
        Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    /* 
     * La siguiente línea que usa `Route::resource` es una forma abreviada y recomendada
     * para registrar las 7 rutas que se muestran arriba. Es más limpia y fácil de mantener.
     */
    Route::resource('posts', PostController::class)->names('posts');

    // Rutas para PDF
    Route::get('/pdf/generate', [PdfController::class, 'generatePdf'])->name('pdf.generate');
    Route::get('/pdf/view', [PdfController::class, 'viewPdf'])->name('pdf.view');

    // Rutas para QR
    Route::get('/qr', [QrController::class, 'qrCodePage'])->name('qr.page');
    Route::post('/qr/generate', [QrController::class, 'generateQrCode'])->name('qr.generate');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas para usuarios (solo usuarios autenticados)
    Route::resource('users', UserController::class);
});
