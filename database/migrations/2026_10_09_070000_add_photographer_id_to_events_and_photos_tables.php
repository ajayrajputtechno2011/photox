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
        Schema::table('events', function (Blueprint $table) {
            if (! Schema::hasColumn('events', 'photographer_id')) {
                $table->foreignId('photographer_id')->nullable()->after('slug')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('events', 'photographer_name')) {
                $table->string('photographer_name')->nullable()->after('photographer_id');
            }
        });

        Schema::table('event_photos', function (Blueprint $table) {
            if (! Schema::hasColumn('event_photos', 'photographer_id')) {
                $table->foreignId('photographer_id')->nullable()->after('event_id')->constrained('users')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_photos', function (Blueprint $table) {
            if (Schema::hasColumn('event_photos', 'photographer_id')) {
                $table->dropForeign(['photographer_id']);
                $table->dropColumn('photographer_id');
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'photographer_id')) {
                $table->dropForeign(['photographer_id']);
                $table->dropColumn('photographer_id');
            }
            if (Schema::hasColumn('events', 'photographer_name')) {
                $table->dropColumn('photographer_name');
            }
        });
    }
};
