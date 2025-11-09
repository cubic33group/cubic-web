<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obras_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->unsignedBigInteger('tamanio')->nullable();
            $table->string('extension', 10)->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_captura')->nullable(); // Fecha en que se tomó la foto
            $table->timestamps();
            
            $table->index(['obra_id', 'created_at']);
            $table->index(['obra_id', 'fecha_captura']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obras_fotos');
    }
};