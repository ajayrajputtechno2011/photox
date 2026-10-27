<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFaqTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_faqs_list(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@photox.com',
        ]);

        Faq::create([
            'question' => 'How does Selfie Search work?',
            'answer' => 'Upload a selfie and our AI will find your photos.',
            'category' => 'selfie_bundles',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/faqs');

        $response->assertOk();
        $response->assertSee('How does Selfie Search work?');
        $response->assertSee('FAQs Management');
    }

    public function test_admin_can_create_faq(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@photox.com',
        ]);

        $response = $this->actingAs($admin)->post('/admin/faqs', [
            'question' => 'What is a Personal License?',
            'answer' => 'A personal license allows personal digital sharing and prints.',
            'category' => 'licenses',
            'order' => 2,
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/faqs');
        $this->assertDatabaseHas('faqs', [
            'question' => 'What is a Personal License?',
            'category' => 'licenses',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_faq(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@photox.com',
        ]);

        $faq = Faq::create([
            'question' => 'Original Question',
            'answer' => 'Original Answer',
            'category' => 'general',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->put("/admin/faqs/{$faq->id}", [
            'question' => 'Updated Question Title',
            'answer' => 'Updated Answer Text',
            'category' => 'orders',
            'order' => 5,
            'is_active' => '0',
        ]);

        $response->assertRedirect('/admin/faqs');
        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'Updated Question Title',
            'is_active' => false,
        ]);
    }

    public function test_about_page_renders_faq_accordion(): void
    {
        Faq::create([
            'question' => 'Can schools bulk publish athletic fixtures?',
            'answer' => 'Yes, schools can partner with PhotoX for private and public albums.',
            'category' => 'photographers',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/about');

        $response->assertOk();
        $response->assertSee('Frequently Asked');
        $response->assertSee('Can schools bulk publish athletic fixtures?');
    }
}
