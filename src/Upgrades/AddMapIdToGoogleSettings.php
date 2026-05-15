<?php

namespace LaravelEnso\Google\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Google\Models\Settings;
use LaravelEnso\Upgrade\Contracts\MigratesData;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class AddMapIdToGoogleSettings implements MigratesTable, MigratesData
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('google_settings', 'map_id');
    }

    public function migrateTable(): void
    {
        Schema::table('google_settings', function (Blueprint $table) {
            $table->string('map_id', 300)->nullable()->after('place_id');
        });
    }

    public function migrateData(): void
    {
        Settings::current()->update([
            'map_id' => Config::get('enso.google.mapId'),
        ]);
    }
}
