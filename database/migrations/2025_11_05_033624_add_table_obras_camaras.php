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
        Schema::create('obras_camaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->string('name'); // Nombre de la cámara (ej: "Cámara Entrada")
            $table->text('url'); // Link de acceso remoto
            $table->string('username')->nullable(); // Usuario de acceso (opcional)
            $table->text('password')->nullable(); // Contraseña encriptada (opcional)
            $table->text('notes')->nullable(); // Notas adicionales
            $table->boolean('is_active')->default(true); // Si está activa o no
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras_camaras');
    }
};