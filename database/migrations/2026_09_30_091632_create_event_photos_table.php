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
        if (! Schema::hasColumn('events', 'is_demo')) {
            Schema::table('events', function (Blueprint $table) {
                $table->boolean('is_demo')->default(false)->after('status');
            });
        }

        Schema::create('event_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('watermarked_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('title')->nullable();
            $table->string('camera_make')->nullable();
            $table->string('camera_model')->nullable();
            $table->string('lens')->nullable();
            $table->string('focal_length')->nullable();
            $table->string('shutter_speed')->nullable();
            $table->string('aperture')->nullable();
            $table->string('iso')->nullable();
            $table->string('flash')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('file_size')->nullable();
            $table->dateTime('captured_at')->nullable();
            $table->string('photographer_name')->nullable();
            $table->string('copyright')->nullable();
            $table->decimal('personal_price', 8, 2)->default(50.00);
            $table->decimal('commercial_price', 8, 2)->default(250.00);
            $table->boolean('is_demo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_photos');

        if (Schema::hasColumn('events', 'is_demo')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('is_demo');
            });
        }
    }
};
