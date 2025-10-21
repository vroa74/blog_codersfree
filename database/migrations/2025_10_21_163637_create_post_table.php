<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->longText('body');
            $table->foreignId('user_id')
            ->constrained('users') // relacionar el post con el usuario
            ->onDelete('cascade') // eliminar el usuario cuando se elimine el post
            ->onUpdate('cascade'); // actualizar el usuario cuando se actualice el post

            $table->foreignId('category_id')
            ->constrained('categories') // relacionar el post con la categoria
            ->onDelete('cascade') // eliminar la categoria cuando se elimine el post
            ->onUpdate('cascade'); // actualizar la categoria cuando se actualice la categoria

            $table->timestamps();

            $table->index('title'); // indexar el titulo del post
            $table->fullText('body'); // indexar el cuerpo del post
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
