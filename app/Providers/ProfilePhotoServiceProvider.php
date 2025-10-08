<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Jetstream;

class ProfilePhotoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Configurar el directorio personalizado para fotos de perfil
        Storage::disk('public')->makeDirectory('fotos');
    }
}
