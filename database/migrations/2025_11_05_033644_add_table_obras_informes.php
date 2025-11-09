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
        Schema::create('obras_informes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->integer('semana_numero'); // Número de semana
            $table->date('fecha_inicio'); // Inicio de la semana
            $table->date('fecha_fin'); // Fin de la semana
            $table->string('titulo')->nullable(); // Título del informe
            $table->text('resumen')->nullable(); // Resumen/contenido del informe
            $table->string('archivo_path')->nullable(); // Ruta al archivo PDF si existe
            $table->timestamps();
            
            // Index para búsquedas rápidas
            $table->index(['obra_id', 'semana_numero']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras_informes');
    }
};