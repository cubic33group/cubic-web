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
        Schema::create('obras_planos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('nombre_archivo'); // Nombre original del archivo
            $table->string('ruta_archivo'); // Ruta completa en storage
            $table->unsignedBigInteger('tamanio')->nullable(); // Tamaño en bytes
            $table->string('extension', 10)->nullable(); // Extensión del archivo (pdf, dwg, etc)
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->timestamps();
            
            // Index para búsquedas rápidas
            $table->index(['obra_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras_planos');
    }
};  