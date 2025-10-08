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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
                        // RFC y CURP ya no serán obligatorios en el registro web.
            // Los dejamos nullable para que el formulario de registro (name/email/password)
            // no falle cuando esos valores no estén presentes.
            $table->string('rfc', 14)->nullable(); // RFC opcional en el registro
            $table->string('curp', 22)->nullable(); // CURP opcional en el registro
            $table->enum('sexo', ['f', 'm'])->nullable(); // Sexo: f (femenino) o m (masculino)
            $table->tinyInteger('nivel')->default(7); // Nivel de acceso del usuario (1-7) , no aparece en la creacion del usuario ni el el profile
            $table->string('puesto', 70)->nullable(); // Puesto o cargo del usuario, no aparece en la creacion del usuario ni el el profile
            $table->boolean('estatus')->default(false); // Estado activo/inactivo del usuario  no aparece en la creacion del usuario ni el el profile
            $table->enum('theme', ['dark', 'light'])->default('dark'); // Tema del usuario: dark o light
            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
