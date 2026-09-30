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
            $table->string('watermark_pattern', 30)->default('fotto_pro')->after('is_tiled');
            $table->integer('single_logo_size')->default(160)->after('logo_size');
            $table->boolean('is_post_purchase_enabled')->default(true)->after('is_motion_mask_enabled');
            $table->string('post_purchase_mode', 30)->default('clean')->after('is_post_purchase_enabled');
            $table->string('sponsor_logo_path')->nullable()->after('post_purchase_mode');
            $table->string('sponsor_placement', 30)->default('bottom_right')->after('sponsor_logo_path');
            $table->integer('sponsor_logo_size')->default(70)->after('sponsor_placement');
            $table->integer('sponsor_opacity')->default(90)->after('sponsor_logo_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('watermark_settings', function (Blueprint $table) {
            $table->dropColumn([
                'watermark_pattern',
                'single_logo_size',
                'is_post_purchase_enabled',
                'post_purchase_mode',
                'sponsor_logo_path',
                'sponsor_placement',
                'sponsor_logo_size',
                'sponsor_opacity',
            ]);
        });
    }
};
