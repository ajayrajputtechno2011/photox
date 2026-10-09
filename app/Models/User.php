<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'status',
    'is_verified',
    'tier',
    'membership_id',
    'custom_storage_limit',
    'custom_commission_rate',
    'custom_features',
    'verification_badge',
    'membership_expires_at',
    'phone',
    'location',
    'specialty',
    'avatar',
    'bio',
    'payout_email',
    'payout_method',
    'admin_notes',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'membership_expires_at' => 'datetime',
            'password' => 'hashed',
            'custom_features' => 'array',
            'is_verified' => 'boolean',
        ];
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isPhotographer(): bool
    {
        return $this->role === 'photographer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Storage limit: Custom override takes precedence, then membership plan, fallback to 10 GB.
     */
    public function getEffectiveStorageLimitAttribute(): string
    {
        if (! empty($this->custom_storage_limit)) {
            return $this->custom_storage_limit;
        }

        return $this->membership?->storage_limit ?: '10 GB';
    }

    /**
     * Commission rate: Custom override takes precedence, then membership plan, fallback to 20%.
     */
    public function getEffectiveCommissionRateAttribute(): string
    {
        if (! empty($this->custom_commission_rate)) {
            return $this->custom_commission_rate;
        }

        return $this->membership?->commission_rate ?: '20%';
    }

    /**
     * Verification / Badge heading: Custom badge takes precedence, else tier/membership title.
     */
    public function getEffectiveBadgeHeadingAttribute(): string
    {
        if (! empty($this->verification_badge)) {
            return $this->verification_badge;
        }

        $tierSlug = strtolower($this->tier ?? ($this->membership?->slug ?? 'starter'));
        if ($tierSlug === 'photoguild' || str_contains($tierSlug, 'guild')) {
            return 'Photo Guild Member';
        }
        if ($tierSlug === 'pro') {
            return 'Pro Member';
        }
        if ($tierSlug === 'standard') {
            return 'Standard Member';
        }

        return ucfirst($tierSlug).' Member';
    }

    /**
     * Check if a feature is enabled (either via custom override array or membership features).
     */
    public function hasFeature(string $feature): bool
    {
        $custom = $this->custom_features;
        if (is_array($custom) && ! empty($custom)) {
            return in_array($feature, $custom);
        }

        $planFeatures = $this->membership?->features;
        if (is_array($planFeatures)) {
            foreach ($planFeatures as $item) {
                if (stripos($item, $feature) !== false) {
                    return true;
                }
            }
        }

        return false;
    }
}
