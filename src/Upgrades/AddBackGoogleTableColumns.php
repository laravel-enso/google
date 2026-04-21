<?php

namespace LaravelEnso\Google\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Google\Models\Settings;
use LaravelEnso\Upgrade\Contracts\MigratesData;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Contracts\ShouldRunManually;
use LaravelEnso\Upgrade\Helpers\Table;

class AddBackGoogleTableColumns implements MigratesTable, MigratesData, ShouldRunManually
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('google_settings', 'recaptcha_secret');
    }

    public function migrateTable(): void
    {
        Schema::table('google_settings', function (Blueprint $table) {
            $table->string('analytics_id')->nullable();
            $table->string('place_id')->nullable();
            $table->string('ads_id', 300)->nullable();
            $table->string('maps_key', 300)->nullable();
            $table->string('geocoding_key', 300)->nullable();
            $table->string('places_key', 300)->nullable();
            $table->string('recaptcha_key', 300)->nullable();
            $table->string('recaptcha_secret', 300)->nullable();
            $table->string('tag_manager_id')->nullable();
        });
    }

    public function migrateData(): void
    {
        Settings::current()->update([
            'analytics_id' => Config::get('enso.google.analyticsId'),
            'ads_id' => Config::get('enso.google.adsId'),
            'place_id' => Config::get('enso.google.placeId'),
            'maps_key' => Config::get('enso.google.mapsKey'),
            'geocoding_key' => Config::get('enso.google.geocodingKey'),
            'places_key' => Config::get('enso.google.placesKey'),
            'recaptcha_key' => Config::get('enso.google.recaptchaKey'),
            'recaptcha_secret' => Config::get('enso.google.recaptchaSecret'),
            'tag_manager_id' => Config::get('enso.google.tagManagerId'),
        ]);
    }
}
