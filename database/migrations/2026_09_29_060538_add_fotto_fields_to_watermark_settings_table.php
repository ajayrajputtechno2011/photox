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
            $table->string('watermark_color')->default('orange')->after('opacity'); // 'orange', 'white', 'monochrome'
            $table->string('security_badge_text')->default('Do not screenshot')->after('both_layout');
            $table->boolean('has_cross_lines')->default(true)->after('security_badge_text');
            $table->boolean('has_security_badge')->default(true)->after('has_cross_lines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('watermark_settings', function (Blueprint $table) {
            $table->dropColumn(['watermark_color', 'security_badge_text', 'has_cross_lines', 'has_security_badge']);
        });
    }
};
