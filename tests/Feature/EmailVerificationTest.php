<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_user_can_view_verification_notice(): void
    {
        $user = User::create([
            'name' => 'Unverified Customer',
            'email' => 'unverified@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'is_verified' => false,
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200);
        $response->assertSee('Verify your');
        $response->assertSee('POPIA Compliance');
        $response->assertSee('unverified@photox.co.za');
    }

    public function test_verified_user_is_redirected_from_verification_notice(): void
    {
        $user = User::create([
            'name' => 'Verified Customer',
            'email' => 'verified@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertRedirect('/customer-dashboard');
    }

    public function test_user_can_verify_email_with_valid_signed_url(): void
    {
        Event::fake([Verified::class]);

        $user = User::create([
            'name' => 'Signee Test',
            'email' => 'signee@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'is_verified' => false,
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('/customer-dashboard');
        $response->assertSessionHas('success');

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $this->assertTrue((bool) $user->fresh()->is_verified);
        Event::assertDispatched(Verified::class);
    }

    public function test_invalid_verification_hash_is_rejected(): void
    {
        $user = User::create([
            'name' => 'Invalid Hash User',
            'email' => 'invalid@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'is_verified' => false,
            'email_verified_at' => null,
        ]);

        $invalidVerificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1('wrong-email@photox.co.za'),
            ]
        );

        $response = $this->actingAs($user)->get($invalidVerificationUrl);

        $response->assertRedirect(route('verification.notice'));
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_user_can_request_resend_verification_email(): void
    {
        $user = User::create([
            'name' => 'Resend Test',
            'email' => 'resend@photox.co.za',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'status' => 'active',
            'is_verified' => false,
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->post(route('verification.send'));

        $response->assertRedirect();
        $response->assertSessionHas('status');
    }

    public function test_signup_creates_unverified_account_pending_popia_verification(): void
    {
        $response = $this->post(route('signup.post'), [
            'name' => 'New Popia User',
            'email' => 'newpopia@example.com',
            'password' => 'SecurePass123!',
            'account-type' => 'member',
            'terms' => 'on',
        ]);

        $response->assertRedirect('/customer-dashboard');

        $user = User::where('email', 'newpopia@example.com')->first();
        $this->assertNotNull($user);
        $this->assertFalse($user->hasVerifiedEmail());
        $this->assertFalse((bool) $user->is_verified);
    }
}
