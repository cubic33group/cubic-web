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
        $table->string('first_name')->nullable()->after('id');
        $table->string('last_name')->nullable()->after('first_name');
        $table->string('phone', 20)->nullable()->after('email');
        $table->string('position')->nullable()->after('phone');
        $table->string('avatar_path')->nullable()->after('position');
        $table->string('status')->default('active')->after('avatar_path');
        $table->timestamp('last_login_at')->nullable()->after('status');
        $table->string('locale', 5)->default('es')->after('last_login_at');
        $table->string('timezone', 50)->nullable()->after('locale');
        $table->unsignedBigInteger('client_id')->nullable()->after('timezone');

        $table->index('client_id');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'first_name',
            'last_name',
            'phone',
            'position',
            'avatar_path',
            'status',
            'last_login_at',
            'locale',
            'timezone',
            'client_id',
        ]);
    });
}
};
