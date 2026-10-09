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
            $table->foreignId('membership_id')->nullable()->after('tier')->constrained('memberships')->nullOnDelete();
            $table->string('custom_storage_limit')->nullable()->after('membership_id');
            $table->string('custom_commission_rate')->nullable()->after('custom_storage_limit');
            $table->json('custom_features')->nullable()->after('custom_commission_rate');
            $table->string('verification_badge')->nullable()->after('custom_features');
            $table->dateTime('membership_expires_at')->nullable()->after('verification_badge');
            $table->string('location')->nullable()->after('phone');
            $table->string('specialty')->nullable()->after('location');
            $table->string('payout_email')->nullable()->after('specialty');
            $table->string('payout_method')->nullable()->after('payout_email');
            $table->text('admin_notes')->nullable()->after('bio');
            $table->boolean('is_verified')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['membership_id']);
            $table->dropColumn([
                'membership_id',
                'custom_storage_limit',
                'custom_commission_rate',
                'custom_features',
                'verification_badge',
                'membership_expires_at',
                'location',
                'specialty',
                'payout_email',
                'payout_method',
                'admin_notes',
                'is_verified',
            ]);
        });
    }
};
