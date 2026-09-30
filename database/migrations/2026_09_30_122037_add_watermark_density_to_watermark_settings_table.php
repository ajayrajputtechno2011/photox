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
        Schema::table('watermark_settings', function (Blueprint $table) {
            $table->string('watermark_density', 20)->default('high')->after('watermark_pattern');
            $table->boolean('has_anti_ai_lines')->default(true)->after('has_cross_lines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('watermark_settings', function (Blueprint $table) {
            $table->dropColumn(['watermark_density', 'has_anti_ai_lines']);
        });
    }
};
