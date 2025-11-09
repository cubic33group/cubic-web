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
    Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // nombre comercial o corto
        $table->string('business_name')->nullable(); // razón social
        $table->string('country_code', 2)->nullable(); // ISO: MX, US, ES, AR...
        $table->string('tax_system', 50)->nullable();  // tipo: RFC, VAT, NIT, RUT...
        $table->string('tax_id', 50)->nullable();      // identificador fiscal
        $table->string('email')->nullable();
        $table->string('phone', 20)->nullable();
        $table->text('address')->nullable();
        $table->foreignId('owner_user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->string('status')->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
