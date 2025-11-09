<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obra_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('role', ['manager', 'residente', 'viewer_obra'])->default('viewer_obra');
            $table->timestamps();
            
            // Índice único para evitar duplicados
            $table->unique(['obra_id', 'user_id']);
            
            // Índice para búsquedas
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obra_user');
    }
};