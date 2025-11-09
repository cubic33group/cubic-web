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
        Schema::table('users', function (Blueprint $table) {
            // Solo ejecutar si existe la columna client_id
            if (Schema::hasColumn('users', 'owner_user_id')) {
                $table->dropForeign(['owner_user_id']); // Si tiene foreign key
                $table->dropColumn('owner_user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('owner_user_id')->nullable()->constrained('clientes');
        });
    }
};