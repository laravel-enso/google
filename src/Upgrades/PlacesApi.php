<?php

namespace LaravelEnso\Google\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class PlacesApi implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('google_settings', 'geocoding_key');
    }

    public function migrateTable(): void
    {
        Schema::table('google_settings', fn (Blueprint $table) => $table
            ->string('places_url')->after('maps_url')->nullable());
        Schema::table('google_settings', fn (Blueprint $table) => $table
            ->string('place_id')->after('analytics_id')->nullable());
        Schema::table('google_settings', fn (Blueprint $table) => $table
            ->string('places_key', 300)->after('geocoding_key')->nullable());
    }
}
