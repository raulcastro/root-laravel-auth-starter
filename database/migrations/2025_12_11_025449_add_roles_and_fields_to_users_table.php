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
            // 1. Role Management
            // super_admin: You (Laravel)
            // admin:       React Manager
            // user:        React Employee
            $table->enum('role', ['super_admin', 'admin', 'user'])
                  ->default('user')
                  ->after('password')
                  ->comment('super_admin|admin|user');

            // 2. Avatar (Profile Picture)
            $table->string('avatar')->nullable()->after('role');

            // 3. Status (Ban/Active)
            $table->boolean('is_active')->default(true)->after('avatar');

            // 4. Soft Deletes
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'is_active']);
            $table->dropSoftDeletes();
        });
    }
};
