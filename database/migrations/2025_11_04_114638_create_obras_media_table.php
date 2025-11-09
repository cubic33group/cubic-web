<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('obras_media', function (Blueprint $table) {
            $table->id();

            // Relación
            $table->foreignId('detalle_id')->constrained('obras_detalles')->cascadeOnDelete();

            // Archivo
            $table->enum('type', ['image','document','video','other'])->default('image');
            $table->string('path');                 // storage/app/public/...
            $table->string('original_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();

            $table->timestamps();

            // Índices
            $table->index(['detalle_id', 'type']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('obras_media');
    }
};
