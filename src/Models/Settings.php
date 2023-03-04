<?php

namespace LaravelEnso\Google\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Google\Database\Factories\SettingsFactory;
use LaravelEnso\Helpers\Casts\Encrypt;
use LaravelEnso\Rememberable\Traits\Rememberable;

class Settings extends Model
{
    use HasFactory;
    use Rememberable;

    protected $table = 'google_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'analytics_id' => Encrypt::class,
        'ads_id' => Encrypt::class,
        'tag_id' => Encrypt::class,
        'maps_key' => Encrypt::class,
        'geocoding_key' => Encrypt::class,
        'recaptcha_key' => Encrypt::class,
        'recaptcha_secret' => Encrypt::class,
    ];

    public static function current()
    {
        return self::cacheGet(1)
            ?? self::factory()->create();
    }

    public static function recaptchaSecret(): ?string
    {
        return self::current()->recaptcha_secret;
    }

    public static function recaptchaUrl(): ?string
    {
        return self::current()->recaptcha_url;
    }

    public static function adsId(): ?string
    {
        return self::current()->ads_id;
    }

    public static function tagManagerId(): ?string
    {
        return self::current()->tag_manager_id;
    }

    public static function mapsKey(): ?string
    {
        return self::current()->maps_key;
    }

    public static function geocodingKey(): ?string
    {
        return self::current()->geocoding_key;
    }

    public static function mapsURL(): ?string
    {
        return self::current()->maps_url;
    }

    protected static function newFactory()
    {
        return SettingsFactory::new();
    }
}
