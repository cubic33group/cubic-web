<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('obras', function (Blueprint $table) {
            // Eliminar la columna status antigua si existe
            $table->dropColumn('status');
        });

        Schema::table('obras', function (Blueprint $table) {
            // Recrear con ENUM correcto
            $table->enum('status', ['planning', 'in_progress', 'paused', 'completed', 'cancelled'])
                  ->default('planning')
                  ->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('obras', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('obras', function (Blueprint $table) {
            $table->string('status')->nullable()->after('description');
        });
    }
};