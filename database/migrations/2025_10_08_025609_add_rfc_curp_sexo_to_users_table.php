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
        Schema::table('users', function (Blueprint $table) {
            $table->string('rfc', 14)->nullable()->after('email');
            $table->string('curp', 22)->nullable()->after('rfc');
            $table->enum('sexo', ['f', 'm'])->nullable()->after('curp');
            $table->tinyInteger('nivel')->default(7)->after('sexo');
            $table->string('puesto', 70)->nullable()->after('nivel');
            $table->boolean('estatus')->default(false)->after('puesto');
            $table->enum('theme', ['dark', 'light'])->default('dark')->after('estatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rfc', 'curp', 'sexo', 'nivel', 'puesto', 'estatus', 'theme']);
        });
    }
};
