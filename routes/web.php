<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\QrController;

    Route::get('/', function () {
        return view('welcome');
    });
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
});
