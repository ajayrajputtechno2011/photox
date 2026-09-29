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
        Schema::create('watermark_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_watermark_enabled')->default(true);
            $table->string('watermark_type')->default('logo'); // 'text', 'logo', 'both'
            $table->string('watermark_text')->default('@pawan_123');
            $table->unsignedInteger('font_size')->default(25);
            $table->unsignedInteger('opacity')->default(65);
            $table->integer('rotation')->default(-12);
            $table->boolean('is_tiled')->default(true);
            $table->string('logo_path')->nullable();
            $table->unsignedInteger('logo_size')->default(40);
            $table->string('both_layout')->default('stacked'); // 'stacked', 'inline', 'alternating'
            $table->unsignedInteger('both_gap')->default(8);
            $table->boolean('is_download_protection_enabled')->default(true);
            $table->boolean('is_motion_mask_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watermark_settings');
    }
};
