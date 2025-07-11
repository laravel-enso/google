<?php

namespace LaravelEnso\Google\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Google\Database\Factories\SettingsFactory;
use LaravelEnso\Helpers\Casts\Encrypt;
use LaravelEnso\Rememberable\Traits\Rememberable;

class Settings extends Model
{
    use HasFactory, Rememberable;

    protected $table = 'google_settings';

    protected $guarded = ['id'];

    public static function current()
    {
        return self::cacheGet(1)
            ?? self::factory()->create();
    }

    public static function recaptchaSecret(): ?string
    {
        return Config::get('enso.google.recaptchaSecret') ?? self::current()->recaptcha_secret;
    }

    public static function recaptchaUrl(): ?string
    {
        return Config::get('enso.google.recaptchaUrl') ?? self::current()->recaptcha_url;
    }

    public static function recaptchaKey(): ?string
    {
        return Config::get('enso.google.recaptchaKey') ?? self::current()->recaptcha_key;
    }

    public static function placeId(): ?string
    {
        return Config::get('enso.google.placeId') ?? self::current()->place_id;
    }

    public static function adsId(): ?string
    {
        return Config::get('enso.google.adsId') ?? self::current()->ads_id;
    }

    public static function tagManagerId(): ?string
    {
        return Config::get('enso.google.tagManagerId') ?? self::current()->tag_manager_id;
    }

    public static function mapsKey(): ?string
    {
        return Config::get('enso.google.mapsKey') ?? self::current()->maps_key;
    }

    public static function geocodingKey(): ?string
    {
        return Config::get('enso.google.geocodingKey') ?? self::current()->geocoding_key;
    }

    public static function placesKey(): ?string
    {
        return Config::get('enso.google.placesKey') ?? self::current()->places_key;
    }

    public static function mapsURL(): ?string
    {
        return Config::get('enso.google.mapsUrl') ?? self::current()->maps_url;
    }

    public static function placesURL(): ?string
    {
        return Config::get('enso.google.placesUrl') ?? self::current()->places_url;
    }

    protected static function newFactory()
    {
        return SettingsFactory::new();
    }

    protected function casts(): array
    {
        return [
            'analytics_id' => Encrypt::class,
            'ads_id' => Encrypt::class,
            'tag_manager_id' => Encrypt::class,
            'place_id' => Encrypt::class,
            'maps_key' => Encrypt::class,
            'geocoding_key' => Encrypt::class,
            'places_key' => Encrypt::class,
            'recaptcha_key' => Encrypt::class,
            'recaptcha_secret' => Encrypt::class,
        ];
    }
}
