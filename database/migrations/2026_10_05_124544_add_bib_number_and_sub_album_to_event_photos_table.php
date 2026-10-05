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
        Schema::table('event_photos', function (Blueprint $table) {
            $table->string('bib_number', 50)->nullable()->after('title');
            $table->string('sub_album', 100)->nullable()->after('bib_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_photos', function (Blueprint $table) {
            $table->dropColumn(['bib_number', 'sub_album']);
        });
    }
};
