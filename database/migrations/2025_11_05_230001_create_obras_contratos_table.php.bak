<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obras_contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->unsignedBigInteger('tamanio')->nullable();
            $table->string('extension', 10)->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            
            $table->index(['obra_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obras_contratos');
    }
};