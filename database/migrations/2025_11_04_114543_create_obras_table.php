<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('client_id')->constrained('clientes')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('manager_user_id')->nullable()->constrained('users')->nullOnDelete();

            // Identidad
            $table->string('code', 50);               // código interno por cliente
            $table->string('name');                   // nombre de la obra
            $table->text('description')->nullable();

            // Estado / avance
            $table->enum('status', ['planning','in_progress','paused','closed'])->default('planning');
            $table->tinyInteger('progress_pct')->unsigned()->default(0); // 0-100

            // Fechas
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Ubicación
            $table->string('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            // Control económico (opcional)
            $table->decimal('budget_amount', 14, 2)->nullable();
            $table->char('currency', 3)->nullable();  // MXN, USD, EUR...

            $table->timestamps();

            // Índices
            $table->unique(['client_id', 'code'], 'obras_client_code_unique');
            $table->index('status');
        });
    }

    public function down(): void {
        Schema::dropIfExists('obras');
    }
};
