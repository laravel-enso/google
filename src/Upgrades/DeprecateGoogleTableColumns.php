<?php

namespace LaravelEnso\Google\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;
use LaravelEnso\Upgrade\Contracts\ShouldRunManually;

class DeprecateGoogleTableColumns implements MigratesTable, ShouldRunManually
{
    public function isMigrated(): bool
    {
        return ! Table::hasColumn('google_settings', 'recaptcha_secret');
    }

    public function migrateTable(): void
    {
        Schema::table('google_settings', fn (Blueprint $table) => $table->dropColumn([
            'analytics_id',
            'ads_id',
            'tag_manager_id',
            'place_id',
            'maps_key',
            'geocoding_key',
            'places_key',
            'recaptcha_key',
            'recaptcha_secret',
        ]));
    }
}
