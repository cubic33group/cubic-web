<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('obra_user', function (Blueprint $table) {
            // Modificar el tipo de columna role
            DB::statement("ALTER TABLE obra_user MODIFY role ENUM('manager', 'residente', 'viewer_obra') DEFAULT 'viewer_obra'");
            
            // Agregar índice único para obra_id y user_id (solo si no existe)
            if (!$this->hasIndex('obra_user', 'obra_user_unique')) {
                $table->unique(['obra_id', 'user_id'], 'obra_user_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('obra_user', function (Blueprint $table) {
            if ($this->hasIndex('obra_user', 'obra_user_unique')) {
                $table->dropUnique('obra_user_unique');
            }
        });
    }
    
    private function hasIndex($table, $indexName)
    {
        $indexes = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        return !empty($indexes);
    }
};