<?php

namespace Tests\Feature;

use App\Models\MediaAsset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMediaManagerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Manager',
            'email' => 'admin_media@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);
    }

    public function test_admin_media_page_loads_successfully(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/media');

        $response->assertStatus(200);
        $response->assertSee('Media Manager');
    }

    public function test_admin_can_fetch_media_api_list(): void
    {
        MediaAsset::create([
            'filename' => 'sample.jpg',
            'title' => 'Sample Banner Asset',
            'file_path' => 'uploads/banners/sample.jpg',
            'mime_type' => 'image/jpeg',
            'file_size' => 1024,
            'folder' => 'banners',
        ]);

        $response = $this->actingAs($this->admin)->getJson('/admin/api/media');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => 'Sample Banner Asset',
        ]);
    }

    public function test_admin_can_upload_media_asset(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test_creative.png', 800, 600);

        $response = $this->actingAs($this->admin)->post('/admin/media', [
            'file' => $file,
            'title' => 'Test Creative',
            'folder' => 'banners',
        ]);

        $response->assertRedirect('/admin/media');
        $this->assertDatabaseHas('media_assets', [
            'title' => 'Test Creative',
            'folder' => 'banners',
        ]);
    }

    public function test_admin_can_delete_media_asset(): void
    {
        $asset = MediaAsset::create([
            'filename' => 'del.jpg',
            'title' => 'Delete Me',
            'file_path' => 'uploads/banners/del.jpg',
            'mime_type' => 'image/jpeg',
            'file_size' => 500,
            'folder' => 'general',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/media/'.$asset->id);

        $response->assertRedirect('/admin/media');
        $this->assertDatabaseMissing('media_assets', [
            'id' => $asset->id,
        ]);
    }
}
