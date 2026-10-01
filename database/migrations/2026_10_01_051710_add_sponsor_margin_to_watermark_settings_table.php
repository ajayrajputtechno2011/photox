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
            $table->integer('sponsor_margin')->default(0)->after('sponsor_opacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('watermark_settings', function (Blueprint $table) {
            $table->dropColumn('sponsor_margin');
        });
    }
};
