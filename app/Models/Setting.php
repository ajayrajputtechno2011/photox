<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Cache for all settings in memory for request lifecycle.
     */
    protected static ?array $settingsCache = null;

    /**
     * Get a setting by key with optional fallback.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (static::$settingsCache === null) {
            static::loadCache();
        }

        return static::$settingsCache[$key] ?? $default;
    }

    /**
     * Set/Update a setting.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'string'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_bool($value) ? ($value ? '1' : '0') : (string) $value,
                'group' => $group,
                'type' => $type,
            ]
        );

        if (static::$settingsCache !== null) {
            static::$settingsCache[$key] = $setting->value;
        }

        return $setting;
    }

    /**
     * Get all settings grouped by their group name.
     */
    public static function getAllGrouped(): array
    {
        return static::all()->groupBy('group')->mapWithKeys(function ($items, $group) {
            return [$group => $items->pluck('value', 'key')->toArray()];
        })->toArray();
    }

    /**
     * Load settings into static memory cache.
     */
    protected static function loadCache(): void
    {
        try {
            static::$settingsCache = static::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            static::$settingsCache = [];
        }
    }
}
