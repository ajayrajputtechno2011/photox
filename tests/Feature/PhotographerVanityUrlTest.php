<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhotographerVanityUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_photographer_can_be_accessed_by_vanity_slug(): void
    {
        $photographer = User::factory()->create([
            'role' => 'photographer',
            'name' => 'Affies Sports Media',
            'slug' => 'affies',
            'status' => 'active',
        ]);

        $response = $this->get('/affies');

        $response->assertStatus(200);
        $response->assertSee('Affies Sports Media');
    }

    public function test_legacy_photographer_details_id_redirects_301_to_vanity_slug(): void
    {
        $photographer = User::factory()->create([
            'role' => 'photographer',
            'name' => 'Affies Sports Media',
            'slug' => 'affies',
            'status' => 'active',
        ]);

        $response = $this->get('/photographer-details/'.$photographer->id);

        $response->assertStatus(301);
        $response->assertRedirect('/affies');
    }

    public function test_photographer_url_attribute_uses_slug(): void
    {
        $photographer = User::factory()->create([
            'role' => 'photographer',
            'name' => 'Anton Demo',
            'slug' => 'anton-demo',
            'status' => 'active',
        ]);

        $this->assertEquals('anton-demo', $photographer->slug);
        $this->assertStringContainsString('/anton-demo', $photographer->url);
    }

    public function test_check_slug_endpoint_validates_uniqueness_and_availability(): void
    {
        $existing = User::factory()->create([
            'role' => 'photographer',
            'name' => 'Existing Studio',
            'slug' => 'existing-studio',
        ]);

        $photographer = User::factory()->create([
            'role' => 'photographer',
            'name' => 'New Guy',
            'slug' => 'new-guy',
        ]);

        $this->actingAs($photographer);

        // Check taken handle
        $responseTaken = $this->getJson(route('photographer.profile.check-slug', ['slug' => 'existing-studio']));
        $responseTaken->assertOk()->assertJson(['available' => false]);

        // Check own handle (available for current user)
        $responseOwn = $this->getJson(route('photographer.profile.check-slug', ['slug' => 'new-guy']));
        $responseOwn->assertOk()->assertJson(['available' => true]);

        // Check brand new available handle
        $responseAvailable = $this->getJson(route('photographer.profile.check-slug', ['slug' => 'brand-new-studio']));
        $responseAvailable->assertOk()->assertJson(['available' => true]);
    }

    public function test_photographer_can_update_their_slug_via_profile_update(): void
    {
        $photographer = User::factory()->create([
            'role' => 'photographer',
            'name' => 'Original Name',
            'slug' => 'original-slug',
        ]);

        $this->actingAs($photographer);

        $response = $this->post(route('photographer.profile.update'), [
            'name' => 'Original Name Updated',
            'slug' => 'custom-brand-url',
        ]);

        $response->assertRedirect();
        $this->assertEquals('custom-brand-url', $photographer->fresh()->slug);
    }
}
