<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;   // para usar la conexion a la base de datos
use App\Http\Controllers\UserController;

    Route::get('/', function () {
        return view('welcome');
    });

    

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('prueba', function () {
       $categories =  DB::table('categories')
                            ->where('id', '=', 2)
                            ->orWhere('id', '=', 3)
                            ->pluck('name');
       return $categories;
    });


    // Rutas para usuarios (solo usuarios autenticados)
    Route::resource('users', UserController::class);
});
