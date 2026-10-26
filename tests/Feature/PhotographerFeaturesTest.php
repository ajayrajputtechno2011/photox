<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PhotographerFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_details_displays_complete_gallery_only_mode(): void
    {
        $category = Category::firstOrCreate(['name' => 'Running Test'], ['slug' => 'running-test']);
        $photographer = User::factory()->create(['role' => 'photographer']);

        $event = Event::create([
            'title' => 'Complete Gallery Test Event',
            'slug' => 'complete-gallery-test-'.time(),
            'category_id' => $category->id,
            'photographer_id' => $photographer->id,
            'allow_individual_sales' => false,
            'full_gallery_price' => 599.00,
            'status' => 'published',
            'total_photos' => 1,
        ]);

        $photo = EventPhoto::create([
            'event_id' => $event->id,
            'photographer_id' => $photographer->id,
            'file_path' => 'https://example.com/test.jpg',
            'watermarked_path' => 'https://example.com/test.jpg',
            'personal_price' => 50.00,
            'commercial_price' => 250.00,
        ]);

        $response = $this->get(route('events.show', $event->slug));
        $response->assertStatus(200);
        $response->assertSee('Complete Gallery Only');
        $response->assertSee('R599');
    }

    public function test_setting_cover_photo_marks_featured_and_updates_event(): void
    {
        $category = Category::firstOrCreate(['name' => 'Cycling Test'], ['slug' => 'cycling-test']);
        $photographer = User::factory()->create(['role' => 'photographer']);

        $event = Event::create([
            'title' => 'Cover Photo Test Event',
            'slug' => 'cover-photo-test-'.time(),
            'category_id' => $category->id,
            'photographer_id' => $photographer->id,
            'status' => 'published',
        ]);

        $photo = EventPhoto::create([
            'event_id' => $event->id,
            'photographer_id' => $photographer->id,
            'file_path' => '/uploads/test-cover.jpg',
            'personal_price' => 50.00,
        ]);

        $response = $this->post(route('admin.dummy.photo.cover', $photo->id));
        $response->assertStatus(302);

        $event->refresh();
        $photo->refresh();

        $this->assertEquals($photo->id, $event->cover_photo_id);
        $this->assertStringContainsString('/protected-photo/'.$photo->id, $event->cover_image);
        $this->assertTrue((bool) $photo->is_featured);
    }

    public function test_photographer_watermark_studio_page_loads_and_saves(): void
    {
        $photographer = User::factory()->create(['role' => 'photographer']);

        // Check studio page loads
        $response = $this->actingAs($photographer)->get(route('photographer.watermark'));
        $response->assertStatus(200);
        $response->assertSee('Watermark Studio');

        // Save custom watermark
        $postResponse = $this->actingAs($photographer)->post(route('photographer.watermark.save'), [
            'watermark_type' => 'text',
            'watermark_text' => 'My Branded Lens',
            'watermark_color' => '#ff8a00',
            'font_size' => 28,
            'opacity' => 70,
            'rotation' => -15,
            'watermark_pattern' => 'fotto_pro',
        ]);

        $postResponse->assertStatus(302);

        $savedSetting = WatermarkSetting::where('user_id', $photographer->id)->first();
        $this->assertNotNull($savedSetting);
        $this->assertEquals('My Branded Lens', $savedSetting->watermark_text);

        // Reset to admin fallback
        $resetResponse = $this->actingAs($photographer)->post(route('photographer.watermark.reset'));
        $resetResponse->assertStatus(302);

        $this->assertNull(WatermarkSetting::where('user_id', $photographer->id)->first());
    }

    public function test_photographer_watermark_studio_saves_full_suite_parameters_via_ajax(): void
    {
        $photographer = User::factory()->create(['role' => 'photographer']);

        $response = $this->actingAs($photographer)->postJson(route('photographer.watermark.save'), [
            'is_watermark_enabled' => 1,
            'watermark_type' => 'both',
            'watermark_text' => 'Studio Pro',
            'watermark_pattern' => 'hex_mesh',
            'watermark_density' => 'ultra',
            'has_anti_ai_lines' => 1,
            'single_logo_size' => 200,
            'watermark_color' => '#06b6d4',
            'font_size' => 32,
            'opacity' => 80,
            'rotation' => -10,
            'security_badge_text' => 'Official Copyright',
            'has_cross_lines' => 1,
            'has_security_badge' => 1,
            'is_download_protection_enabled' => 1,
            'is_motion_mask_enabled' => 1,
            'is_post_purchase_enabled' => 1,
            'post_purchase_mode' => 'sponsor_branded',
            'sponsor_placement' => 'middle_bottom',
            'sponsor_logo_size' => 90,
            'sponsor_opacity' => 85,
            'sponsor_margin' => 10,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $saved = WatermarkSetting::where('user_id', $photographer->id)->first();
        $this->assertNotNull($saved);
        $this->assertEquals('Studio Pro', $saved->watermark_text);
        $this->assertEquals('hex_mesh', $saved->watermark_pattern);
        $this->assertEquals('ultra', $saved->watermark_density);
        $this->assertTrue((bool) $saved->has_anti_ai_lines);
        $this->assertTrue((bool) $saved->is_download_protection_enabled);
        $this->assertTrue((bool) $saved->is_motion_mask_enabled);
        $this->assertTrue((bool) $saved->is_post_purchase_enabled);
        $this->assertEquals('sponsor_branded', $saved->post_purchase_mode);
        $this->assertEquals('middle_bottom', $saved->sponsor_placement);
        $this->assertEquals(90, $saved->sponsor_logo_size);
    }

    public function test_photographer_can_create_event_and_upload_photos_via_json(): void
    {
        $category = Category::firstOrCreate(['name' => 'Athletics Test'], ['slug' => 'athletics-test']);
        $photographer = User::factory()->create(['role' => 'photographer']);

        $photoFile = UploadedFile::fake()->image('test_action.jpg', 800, 600);

        $response = $this->actingAs($photographer)->post(route('photographer.upload.store'), [
            'title' => 'Cape Town Sprint 2026',
            'category_id' => $category->id,
            'location' => 'Cape Town',
            'event_date' => '2026-10-26',
            'personal_price' => 85.00,
            'commercial_price' => 200.00,
            'photos' => [$photoFile],
        ], [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'photos_count' => 1,
        ]);

        $this->assertDatabaseHas('events', [
            'title' => 'Cape Town Sprint 2026',
            'photographer_id' => $photographer->id,
            'total_photos' => 1,
        ]);

        $event = Event::where('title', 'Cape Town Sprint 2026')->first();

        // Test Batch 2 (uploadMorePhotos)
        $batch2File = UploadedFile::fake()->image('batch_two.png', 800, 600);
        $batchResponse = $this->actingAs($photographer)->post(route('photographer.gallery.upload_photos', $event->id), [
            'photos' => [$batch2File],
        ], [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $batchResponse->assertStatus(200);
        $batchResponse->assertJson([
            'success' => true,
            'count' => 1,
            'total_photos' => 2,
        ]);

        $event->refresh();
        $this->assertEquals(2, $event->total_photos);
    }
}
