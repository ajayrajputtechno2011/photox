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
            $table->string('role')->default('customer')->after('email'); // 'customer', 'photographer', 'admin'
            $table->string('status')->default('active')->after('role'); // 'active', 'pending_approval', 'suspended'
            $table->string('tier')->nullable()->after('status'); // 'starter', 'pro', 'studio'
            $table->string('phone')->nullable()->after('tier');
            $table->string('avatar')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'tier', 'phone', 'avatar', 'bio']);
        });
    }
};
