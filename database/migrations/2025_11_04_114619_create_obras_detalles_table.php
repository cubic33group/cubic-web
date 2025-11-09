<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('obras_detalles', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('obra_id')->constrained('obras')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();

            // Clasificación del evento
            $table->enum('type', ['note','progress','issue','delivery','inspection'])->default('note');

            // Contenido
            $table->string('title')->nullable();
            $table->text('body');

            // Ubicación puntual del evento
            $table->string('place_name')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            // Si este evento actualiza avance
            $table->tinyInteger('progress_pct')->unsigned()->nullable();

            // Fecha/hora del evento (por si difiere de created_at)
            $table->dateTime('event_date')->useCurrent();

            $table->timestamps();

            // Índices
            $table->index(['obra_id', 'event_date']);
            $table->index(['obra_id', 'type']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('obras_detalles');
    }
};
